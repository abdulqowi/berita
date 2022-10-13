<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        return view('frontend.home', [
            'post_most_viewed' => Blog::limit(5)->get(),
            'posts' => Blog::latest()->simplePaginate(10),
            'categories' => Category::get(),
        ]);
    }

    public function show(Blog $blog)
    {
        if ($blog) {
            return view('frontend.blog', [
                'title' => $blog->title,
                'post' => $blog,
                'post_related' => Blog::whereHas('categories', function ($q) use ($blog) {
                    return $q->whereIn('name', $blog->categories->pluck('name'));
                })
                ->where('id', '!=', $blog->id)
                ->limit(5)
                ->get(),
            ]);
        } else {
            abort(404);
        }
    }

    public function search()
    {

    }

    public function category(){}
}
