<?php

namespace App\Http\Controllers;

use App\DataTables\BlogsDataTable;
use App\Models\Blog;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\KontolJaran;

class BlogController extends Controller
{
    public function index(BlogsDataTable $datatable)
    {
        return $datatable->render('blog.blog');
    }

    public function show($id)
    {
        $blog = Blog::with('categories', 'user')->findOrFail($id);
        return response()->json($blog);
    }

    public function create(){
        return view('blog.create');
    }

    public function store(Request $request){
        $this->validate(request(),[
            'title' =>'required',
            'body' =>'required'
        ]);

        Blog::create([
            'title' =>request('title'),
            'image' =>request('image') ? request()->file('image')->store('img/blogs') : null,
            'slug' =>Str::slug(request('title')) ,
            'user_id' => Auth::user()->id,
            'body' =>request('body'),

        ]);
        flash('Data berhasil ditambahkan!');
        return redirect()->route('blogs.index');
    }
    public function edit(Blog $blog){
        return view('blog.edit', compact('blog'));
    }

    public function destroy(Blog $blog)
    {
        $blog->delete();
        flash('Data berhasil dihapus!');
        return redirect()->route('blogs.index');
    }
}