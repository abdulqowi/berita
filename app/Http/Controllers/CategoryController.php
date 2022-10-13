<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    public function index()
    {
        $data = DB::table('Categories')->get();
        return view('categories.categories',compact('data'));
    }
    public function store(Request $request){
        $this->validate(request(),[
            'name' =>'required',
        ]);
        
        Category::create([
            'name' =>request('name'),
            'slug' =>Str::slug(request('name')) ,
        ]);

        // $json=[
        //     'msg' => 'berhasil',
        //     'status' => true
        // ];
        // } catch (\Exception $e) {
        //   $json =[
        //     'msg' => 'gagal',
        //     'status' => false
        //   ]
        flash('Data berhasil ditambahkan!');
        return redirect()->route('categories.index');
    }
    public function create(){
        return view('categories.create');
    }
}
