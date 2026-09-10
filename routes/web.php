<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::inertia('/', 'Welcome')->name('home');
// Route::inertia('login', 'auth/Login')->name('login');
Route::get('login', function (){
    Inertia::flash('error','this test is successfull');
    return Inertia::render('auth/Login');
})->name('login');
Route::inertia('register', 'auth/Register')->name('register');
Route::inertia('password_forgotten', 'auth/PasswordForgotten')->name('password.forgotten');

Route::post('register', [UserController::class, 'create'])->name('register');
Route::post('login', [UserController::class, 'login'])->name('login');

Route::middleware(['auth'])->group(function () {
    Route::inertia('dashboard', 'user/Dashboard')->name('dashboard');
    Route::inertia('dashboard/email/verify','auth/EmailVerify')->name('verification.notice');
});


Route::get('/user/{id}/tasks', [TaskController::class, 'index'])->name('user.tasks');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {

    $request->fulfill();



    return redirect()->intended(route('dashboard'));

})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {

    $request->user()->sendEmailVerificationNotification();


    Inertia::flash('success', 'Verification link sent!');

    return back();

})->middleware(['auth', 'throttle:6,1'])->name('verification.send');
