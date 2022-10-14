<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    public function create(){
        return view('blog.create');
    }

    public function index()
    {
        $data = DB::table('blogs')->get();
        return view('blog.blog',compact('data'));
    }
    public function store(Request $request){
        $this->validate(request(),[
            'title' =>'required',
            '
        ]);

        Category::create([
            'title' =>request('title'),
            'slug' =>Str::slug(request('name')) ,
        ]);
        flash('Data berhasil ditambahkan!');
        return redirect()->route('categories.index');
    }
}
