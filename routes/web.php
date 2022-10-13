<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\{ExampleController, HomeController, UserController, RoleController, CategoryController};

Route::get('/',  [HomeController::class, 'index'])->name('home');
Route::get('category',  [HomeController::class, 'category'])->name('category');
Route::get('blog/{blog:slug}',  [HomeController::class, 'show'])->name('blog.show');
Route::get('login', [LoginController::class, 'showLoginForm']);
Route::post('login', [LoginController::class, 'login'])->name('login');
Route::post('logout',  [LoginController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('home', [
            'title' => 'Home'
        ]);
    })->name('dashboard');

    Route::resources(['users' => UserController::class]);
    Route::resources(['roles' => RoleController::class]);
    Route::resources(['examples' => ExampleController::class]);
    Route::resources(['categories' => CategoryController::class]);

});
