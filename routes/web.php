<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;
use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
        Route::get('/news', [NewsController::class, 'index'])->name('admin.news.index');
        Route::get('/products', [ProductController::class, 'index'])->name('admin.products.index');
        
        // CRUD Routes Pertemuan 14
        Route::resource('users', UserController::class);
        Route::resource('categories', CategoryController::class);
        Route::resource('articles', ArticleController::class);
    });
});

require __DIR__.'/auth.php';

// Route Group Middleware Auth untuk bagian backend Admin
Route::middleware(['auth'])->group(function () {

    Route::get('/admin/dashboard', function () {
        $total_berita = Article::count();
        $total_kategori = Category::count();
        $total_user = User::count();
        
        return view('admin.dashboard', compact('total_berita', 'total_kategori', 'total_user'));
    })->name('admin.dashboard');

});
// Auth::routes(); // Komentar: Redundan karena sudah ada require auth.php di atas

Route::get('/home', [HomeController::class, 'index'])->name('home');


