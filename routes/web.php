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

    // register routes
    Route::inertia('register', 'auth/Register')->name('register');
    Route::post('register', [UserController::class, 'create'])->name('register');

    // login  routes
    Route::inertia('login', 'auth/Login')->name('login');
    Route::post('login', [UserController::class, 'login'])->name('login');

    Route::inertia('password_forgotten', 'auth/PasswordForgotten')->name('password.forgotten');
    Route::post('/forgot-password', [UserController::class, 'sendEmailToResetThePassword'])->name('password.email');

    Route::get('/reset-password/{token}', function (Request $request, string $token) {
        // return view('auth.reset-password', ['token' => $token]);
        return Inertia::render('auth/PasswordReset', [
            'token' => $token,
            'email' => $request->email,
        ]);
    })->middleware('guest')->name('password.reset');

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

        return $status === Password::PasswordReset

            ? redirect()->route('login')->with('status', __($status))

            : back()->withErrors(['email' => [__($status)]]);

    })->middleware('guest')->name('password.update');
});

Route::middleware(['auth'])->group(function () {
    Route::withoutMiddleware(['verified'])->group(function () {
        Route::inertia('email/verify', 'auth/EmailVerify')->name('verification.notice');
        Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {

            $request->fulfill();

            return redirect()->intended(route('dashboard'));

        })->middleware(['signed'])->name('verification.verify');

        Route::post('/email/verification-notification', function (Request $request) {

            $request->user()->sendEmailVerificationNotification();

            Inertia::flash('success', 'Verification link sent!');

            return back();

        })->middleware(['throttle:6,1'])->name('verification.send');
        Route::post('logout', [UserController::class, 'logout'])->name('logout');

    });

    Route::middleware(['verified'])->group(function () {
        Route::inertia('dashboard', 'user/Dashboard')->name('dashboard');
        Route::inertia('tasks', 'user/Tasks')->name('tasks');
        Route::get('/user/{id}/tasks', [TaskController::class, 'index'])->name('user.tasks');

    });
});

