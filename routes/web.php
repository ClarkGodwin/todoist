<?php

/**
 * 1. Login routes
 * 2. Register routes
 * 3. Password Reset Routes
 * 4. Email verification routes
 */

use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::inertia('/', 'Welcome')->name('home');

// ===============================1. Login routes=======================================
Route::inertia('login', 'auth/Login')->name('login');
Route::post('login', [UserController::class, 'login'])->name('login');

// ===============================2. Register routes=======================================
Route::inertia('register', 'auth/Register')->name('register');
Route::post('register', [UserController::class, 'create'])->name('register');

// =========================3. Password reset routes==================================
Route::middleware(['guest'])->group(function () {
    Route::inertia('password_forgotten', 'auth/PasswordForgotten')->name('password.forgotten');
    Route::post('/forgot-password', [UserController::class, 'sendEmailToResetThePassword'])->name('password.email');
    Route::get('/reset-password/{token}', [UserController::class, 'renderPasswordResetForm'])->name('password.reset');
    Route::post('/reset-password', [UserController::class, 'resetThePassword'])->name('password.update');
});

Route::middleware(['auth'])->group(function () {
    Route::withoutMiddleware(['verified'])->group(function () {
        // ====================4. Email verification routes=============================
        Route::inertia('email/verify', 'auth/EmailVerify')->name('verification.notice');
        Route::post('/email/verification-notification', [UserController::class, 'sendEmailVerificationLink'])->middleware(['throttle:6,1'])->name('verification.send');
        Route::get('/email/verify/{id}/{hash}', [UserController::class, 'verifyTheEmail'])->middleware(['signed'])->name('verification.verify');

        // logout
        Route::post('logout', [UserController::class, 'logout'])->name('logout');
    });

    Route::middleware(['verified'])->group(function () {
        Route::inertia('dashboard', 'user/Dashboard')->name('dashboard');
        Route::inertia('account', 'user/Account')->name('account');

        Route::inertia('modify/account-info', 'user/FormModifyAccountInfo')->name('modify.account-info');
        Route::put('modify/account-info', [UserController::class, 'updateUserInfo'])->name('modify.account-info');

        Route::inertia('modify/password', 'user/FormModifyPassword')->name('modify.password');
        Route::put('modify/password', [UserController::class, 'updatePassword'])->name('modify.password');

        Route::delete('delete', [UserController::class,'deleteUser'])->name('delete.user');

        Route::inertia('tasks', 'user/Tasks')->name('tasks');
        Route::get('/user/{id}/tasks', [TaskController::class, 'index'])->name('user.tasks');

    });
});
