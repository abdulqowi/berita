<?php

namespace App\Http\Controllers;

use Exception;
use App\DataTables\RoleDataTable;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\{RoleUpdateRequest, RoleStoreRequest};

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:role-read', ['only' => ['index','show']]);
        $this->middleware('permission:role-create', ['only' => ['create','store']]);
        $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }

    public function index(RoleDataTable $datatable)
    {
        return $datatable->render('roles.index');
    }

    public function show($id)
    {
        $role = Role::with('permissions')->findOrFail($id);
        return response()->json($role);
    }

    public function create()
    {
        return view('roles.create', [
            'role' => new Role(),
            'permissions' => Permission::get(),
        ]);
    }

    public function store(RoleStoreRequest $request)
    {
        $request->validated();

        DB::transaction(function () {
            $role = Role::create([
                'name' => request('name')
            ]);

            $role->syncPermissions(request('permission'));
        });

        flash('Data berhasil ditambahkan!');
        return redirect()->route('roles.index');
    }

    public function edit(Role $role)
    {
        return view('roles.edit', [
            'role' => $role,
            'permissions' => Permission::get()
        ]);
    }

    public function update(RoleUpdateRequest $request, Role $role)
    {
        $request->validated();

        DB::beginTransaction();
        try {
            $role->update([
                'name' => request('name')
            ]);
            $role->syncPermissions(request('permission'));
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }

        flash('Data berhasil diedit!');
        return redirect()->route('roles.index');
    }

    public function destroy(Role $role)
    {
        $role->delete();
        flash('Data berhasil dihapus!');
        return redirect()->route('roles.index');
    }
}
