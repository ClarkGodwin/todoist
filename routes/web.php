<?php

use App\Http\Controllers\ShowUsersTest;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ShowUsersTest::class, 'index'])->name('home');

Route::get('/user/{id}/dashboard', [UserController::class,'index'])->name('user.dashboard');
Route::get('/user/{id}/tasks', [TaskController::class,'index'])->name('user.tasks');
