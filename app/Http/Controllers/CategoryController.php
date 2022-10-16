<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:category-read', ['only' => ['index','show']]);
        $this->middleware('permission:category-create', ['only' => ['create','store']]);
        $this->middleware('permission:category-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:category-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $data = DB::table('categories')->get();
        return view('categories.categories',compact('data'));
    }
    public function store(Request $request){
        $this->validate(request(),[
            'name' =>'required|unique:categories',
        ]);

        Category::create([
            'name' =>request('name'),
            'slug' =>Str::slug(request('name')) ,
        ]);

        
        flash('Data berhasil ditambahkan!');
        return redirect()->route('categories.index');
    }
    public function create(){
        return view('categories.create');
    }

    public function destroy($id) {
        try {
            DB::transaction(function() use($id) {
                DB::table('categories')->where('id', $id)->delete();
            });
            $json=[
                'msg'       =>'success',
                'status' =>true
            ];
        } catch (\PDOException $e) {
            $json= [
               'msg' => 'error',
               'status' => false,
               'error' => $e,
            ];
        };
        flash('Data berhasil dihapus!');
        return redirect()->route('categories.index');
    }
    public function update(Category $category){
        $this->validate(request(),[
            'name' =>'required|unique:categories,name,' . $category->id,
        ]);

        $category->update([
            'name' =>request('name'),
            'slug' =>Str::slug(request('name')) ,

        ]);
        flash('Data berhasil ditambahkan!');
        return redirect()->route('categories.index');
    }
        public function edit(Category $category){
        return view('categories.edit', compact('category'));
    }
}
