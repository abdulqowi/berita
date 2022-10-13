<?php

namespace App\Http\Controllers;

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
            'category' =>'required',
            'slug' =>'required',
        ]);
        db::transaction(function()use($request)
        {
            DB::table('categories')->insert(
                [
                    'categories' => $request->categories_name,
                   'slug' => $request->slug,
                   'created_at' =>('Y-m-d H:i:s'),
                ]
                );
        });
    }
    public function create(){
        return view('categories.create');
    }
}
