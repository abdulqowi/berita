<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\DataTables\UserDataTable;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\{UserStoreRequest, UserUpdateRequest};

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:user-read', ['only' => ['index','show']]);
        $this->middleware('permission:user-create', ['only' => ['create','store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }

    public function index(UserDataTable $datatable)
    {
        return $datatable->render('users.index');
    }

    public function show($id)
    {
        $user = User::with('roles')->findOrFail($id);
        return response()->json($user);
    }

    public function create()
    {
        return view('users.create', [
            'user' => new User(),
            'roles' => Role::get(),
        ]);
    }

    public function store(UserStoreRequest $request)
    {
        $request->validated();

        DB::transaction(function () {
            $user = User::create([
                'name' => request('name'),
                'email' => request('email'),
                'password' => Hash::make(request('password')),
            ]);
            $user->syncRoles(request('roles'));
        });

        flash('Data berhasil ditambahkan!');
        return redirect()->route('users.index');
    }

    public function edit(User $user)
    {
        return view('users.edit', [
            'roles' => Role::get(),
            'user' => $user,
        ]);
    }

    public function update(User $user, UserUpdateRequest $request)
    {
        $request->validated();

        DB::beginTransaction();
        try {
            $user->update([
                'name' => request('name'),
                'email' => request('email'),
                'password' => request('password') ? Hash::make(request('password')) : $user->password,
            ]);

            $user->syncRoles(request('roles'));
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
        }
        flash('Data berhasil diedit!');
        return redirect()->route('users.index');
    }

    public function destroy(User $user)
    {
        $user->delete();
        flash('Data berhasil dihapus!');
        return redirect()->route('users.index');
    }
}
