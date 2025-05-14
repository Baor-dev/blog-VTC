<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\AdminDashboard;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\UserController;


Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::middleware(['auth'])->group(function () {
    Route::get('/admin', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});

Route::get('/admin', function () {
    if (!Auth::check()) {
        return redirect('/login'); // Redirect unauthenticated users
    }

    if (Auth::user()->role !== 'admin') {
        return redirect('/'); // Redirect non-admin users
    }

    return view('admin.dashboard'); // Load admin view for actual admins
})->name('admin.dashboard');

Route::get('/admin/users', [AdminUserController::class, 'index'])->name('admin.users');
Route::get('/admin/posts', [AdminPostController::class, 'index'])->name('admin.posts');
Route::get('/admin/stats', [AdminController::class, 'stats'])->name('admin.stats');
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

Route::put('/admin/users/{id}/update-role', [AdminUserController::class, 'updateRole'])
    ->name('admin.users.updateRole');
Route::delete('/admin/users/{id}', [AdminUserController::class, 'destroy'])
    ->name('admin.users.destroy');

Route::get('/admin/posts', [AdminPostController::class, 'index'])->name('admin.posts');
Route::put('/admin/posts/{id}/approve', [AdminPostController::class, 'approve'])->name('admin.posts.approve');
Route::delete('/admin/posts/{id}/reject', [AdminPostController::class, 'reject'])->name('admin.posts.reject');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Show post creation form
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');

// Handle form submission (saving post)
Route::post('/posts/create', [PostController::class, 'store'])->name('posts.store');

Route::get('/admin', function () {
    return redirect()->route('admin.users');
});

Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
});

Route::get('/admin/dashboard', function () {
    return redirect('/admin');
})->name('admin.dashboard');

Route::get('/profile', [UserController::class, 'profile'])->name('profile');
Route::get('/profile/edit', [UserController::class, 'edit'])->name('profile.edit');
Route::patch('/profile/update', [UserController::class, 'update'])->name('profile.update');

Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
Route::patch('/posts/{post}', [PostController::class, 'update'])->name('posts.update');

Route::delete('/posts/delete-image', [PostController::class, 'deleteImage'])->name('posts.delete_image');
Route::post('/posts/delete-banner', [PostController::class, 'deleteBanner'])->name('posts.delete_banner');

Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');

require __DIR__.'/auth.php';
