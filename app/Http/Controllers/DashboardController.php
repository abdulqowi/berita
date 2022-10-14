<?php

namespace App\Http\Controllers;

use App\Models\{Category, User, Blog};

class DashboardController extends Controller
{
    public function index()
    {
        return view('home', [
            'title' => 'Dashboard',
            'blogs' => Blog::get()->count(),
            'categories' => Category::get()->count(),
            'users' => User::get()->count(),
        ]);
    }
}
