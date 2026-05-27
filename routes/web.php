<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Admin News Routes
    Route::prefix('admin')->group(function () {
        Route::get('/news', [\App\Http\Controllers\NewsController::class, 'index'])->name('admin.news.index');
        Route::get('/products', [\App\Http\Controllers\ProductController::class, 'index'])->name('admin.products.index');
    });
});

require __DIR__.'/auth.php';

// Route Group Middleware Auth untuk bagian backend Admin
Route::middleware(['auth'])->group(function () {

    Route::get('/admin/dashboard', function () {
        $total_berita = \App\Models\News::count();
        $total_kategori = \App\Models\Category::count();
        $total_user = \App\Models\User::count();
        
        return view('admin.news.dashboard', compact('total_berita', 'total_kategori', 'total_user'));
    });

});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
