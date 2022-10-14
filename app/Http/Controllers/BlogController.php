<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\DataTables\BlogsDataTable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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

    public function create()
    {
        return view('blog.create');
    }

    public function store(Request $request){
        $this->validate(request(),[
            'title' =>'required|max:255|unique:blogs',
            'body' =>'required',
            'image' => 'image|mimes:jpg,jpeg,png|max:2058',
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

    public function update(Blog $blog)
    {
        $this->validate(request(), [
            'title' => 'required|max:255|unique:blogs,title,' . $blog->id,
            'body' => 'required',
            'image' => 'image|mimes:jpg,jpeg,png|max:2058',
        ]);

        // Pengkondisian update gambar
        if (request('image')) {
            // Jika ada request maka delete old img
            Storage::delete($blog->image);
            $image = request()->file('image')->store('img/blogs');
        } elseif ($blog->image) {
            // jika tidak ada biarkan old image
            $image = $blog->image;
        } else {
            $image = null;
        }

        $blog->update([
            'title' => request('title'),
            'image' => $image,
            'slug' => Str::slug(request('title')) ,
            'body' =>request('body'),
        ]);

        flash('Data berhasil diedit!');
        return redirect()->route('blogs.index');
    }

    public function destroy(Blog $blog)
    {
        Storage::delete($blog->image);
        $blog->delete();
        flash('Data berhasil dihapus!');
        return redirect()->route('blogs.index');
    }
}
