<?php
use App\Http\Controllers\Admin\AdminAuthController;
use Illuminate\Support\Facades\Route;


Route::get('/login', [AdminAuthController::class, 'index'])->name('admin.login');
Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.login');

Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
Route::get('/forgot-password', [AdminAuthController::class, 'forgetPassword'])->name('password.forget');
Route::get('/reset-password', [AdminAuthController::class, 'resetPassword'])->name('password.reset');
Route::post('/update-password', [AdminAuthController::class, 'update'])->name('password.update');
Route::post('/submit-forgot-password', [AdminAuthController::class, 'sendResetLink'])->name('password.email');
