<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\{DashboardController, ExampleController, HomeController, UserController, RoleController, CategoryController, BlogController};


// Route Autentikasi
Route::get('login', [LoginController::class, 'showLoginForm']);
Route::post('login', [LoginController::class, 'login'])->name('login');
Route::post('logout',  [LoginController::class, 'logout'])->name('logout');

// Home
Route::get('/',  [HomeController::class, 'index'])->name('home');
Route::get('about_us',  [HomeController::class, 'about_us'])->name('about_us');
Route::get('{blog:slug}',  [HomeController::class, 'show'])->name('blog.show');
Route::get('category/{category:slug}',  [HomeController::class, 'category'])->name('category');

Route::middleware('auth')->group(function () {
    Route::prefix('admin')->group(function () {
        // Route::get('/dashboard', function () {
        //     return view('home', [
        //         'title' => 'Home'
        //     ]);
        // })->name('dashboard');
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::resources(['users' => UserController::class]);
        Route::resources(['roles' => RoleController::class]);
        Route::resources(['examples' => ExampleController::class]);
        Route::resources(['categories' => CategoryController::class]);
        Route::resources(['blogs' => BlogController::class]);
    });
});
