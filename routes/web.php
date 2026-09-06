<?php

use App\Http\Controllers\ShowUsersTest;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::inertia('/', 'Welcome')->name('home');
Route::inertia('login', 'auth/Login')->name('login');
Route::inertia('register','auth/Register')->name('register');
Route::inertia('password_forgotten','auth/PasswordForgotten')->name('password.forgotten');

Route::get('/user/{id}/dashboard', [UserController::class,'index'])->name('user.dashboard');
Route::get('/user/{id}/tasks', [TaskController::class,'index'])->name('user.tasks');
