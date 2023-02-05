<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\AdminController;

Route::get('/', [AdminController::class, 'index'])->name('home')->middleware('admin:admin');
Route::get('about', [AdminController::class, 'about'])->name('about')->middleware('admin:admin');

// Admin section
Route::get('login', [AdminController::class, 'login'])->name('login');
Route::any('login/submit', [AdminController::class, 'login_submit'])->name('login.submit');

Route::get('forgot-password', [AdminController::class , 'forgot'])->name('forgot.password');
Route::any('forgot-password-submit', [AdminController::class , 'forgot_submit'])->name('forgot.submit');

Route::get('reset-password/{token}/{email}', [AdminController::class , 'reset'])->name('reset.password');
Route::any('reset-password-submit', [AdminController::class , 'reset_submit'])->name('reset.submit');

Route::get('profile', [AdminController::class, 'profile'])->name('profile');
Route::any('profile-submit', [AdminController::class, 'profile_submit'])->name('profile.submit');

Route::get('logout', [AdminController::class, 'logout'])->name('logout');