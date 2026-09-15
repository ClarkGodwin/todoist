<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Inertia\Inertia;

Route::middleware(['guest'])->group(function () {
    Route::inertia('/', 'Welcome')->name('home');

    // login  routes
    Route::inertia('login', 'auth/Login')->name('login');
    Route::post('login', [UserController::class, 'login'])->name('login');

    // register route
    Route::inertia('register', 'auth/Register')->name('register');
    Route::post('register', [UserController::class, 'create'])->name('register');

    Route::inertia('password_forgotten', 'auth/PasswordForgotten')->name('password.forgotten');

    Route::post('/forgot-password', function (Request $request) {

        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(

            $request->only('email')

        );

        if ($status === Password::ResetLinkSent) {
            Inertia::flash('status', __($status));

            return back();
        }

        return back()->withErrors([
            'email' => __($status),
        ]);

    })->name('password.email');

    Route::get('/reset-password/{token}', function (Request $request, string $token) {
        return Inertia::render('auth/PasswordReset', [
            'token' => $token,
            'email' => $request->email,
        ]);
    })->name('password.reset');

    Route::post('/reset-password', function (Request $request) {

        $request->validate([

            'token' => 'required',

            'email' => 'required|email',

            'password' => 'required|min:1|confirmed',

        ]);

        $status = Password::reset(

            $request->only('email', 'password', 'password_confirmation', 'token'),

            function (User $user, string $password) {

                $user->forceFill([

                    'password' => Hash::make($password),

                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));

            }

        );

        Inertia::flash('status', __($status));

        return redirect()->route('login');

    })->name('password.update');

});

Route::middleware(['auth'])->group(function () {
    Route::inertia('dashboard', 'user/Dashboard')->name('dashboard');
    Route::inertia('tasks', 'user/Tasks')->name('tasks');
    Route::inertia('dashboard/email/verify', 'auth/EmailVerify')->name('verification.notice');
    Route::post('logout', [UserController::class, 'logout'])->name('logout');

    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {

        $request->fulfill();

        return redirect()->intended(route('dashboard'));

    })->middleware(['auth', 'signed'])->name('verification.verify');

});

Route::get('/user/{id}/tasks', [TaskController::class, 'index'])->name('user.tasks');
