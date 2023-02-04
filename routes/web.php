<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\AdminController;

Route::get('/', [AdminController::class, 'index'])->name('front.home')->middleware('admin:admin');
Route::get('about', [AdminController::class, 'about'])->name('front.about')->middleware('admin:admin');

Route::get('login', [AdminController::class, 'login'])->name('front.login');
Route::any('login/submit', [AdminController::class, 'login_submit'])->name('front.login.submit');

Route::get('forgot-password', [AdminController::class , 'forgot'])->name('front.forgot.password');
Route::any('forgot-password-submit', [AdminController::class , 'forgot_submit'])->name('forgot.submit');

Route::get('reset-password', [AdminController::class , 'reset'])->name('front.reset.password');
Route::any('reset-password-submit', [AdminController::class , 'reset_submit'])->name('reset.submit');
Route::any('reset-password-verify', [AdminController::class , 'reset_verify'])->name('reset.verify');

Route::get('logout', [AdminController::class, 'logout'])->name('front.logout');