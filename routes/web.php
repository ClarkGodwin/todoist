<?php

use App\Http\Controllers\ShowUsersTest;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ShowUsersTest::class, 'index'])->name('home');

Route::get('/user/{id}', [UserController::class,'index'])->name('user.index');
