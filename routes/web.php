<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\PostController as AdminPostController;


Route::get('/', [FrontendController::class, 'index'])->name('home');
Route::get('/categories/{slug}', [FrontendController::class, 'category'])->name('categories.show');
Route::get('/blog/{slug}', [FrontendController::class, 'post'])->name('posts.show');


// Dashboard (from Breeze) is already protected by auth middleware in routes/auth.php
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function(){
Route::view('/', 'admin.dashboard')->name('dashboard');


// Category management
Route::get('/categories', [AdminCategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/create', [AdminCategoryController::class, 'create'])->name('categories.create');
Route::post('/categories', [AdminCategoryController::class, 'store'])->name('categories.store');


// Post management
Route::get('/posts', [AdminPostController::class, 'index'])->name('posts.index');
Route::get('/posts/create', [AdminPostController::class, 'create'])->name('posts.create');
Route::post('/posts', [AdminPostController::class, 'store'])->name('posts.store');
});


require __DIR__.'/auth.php';