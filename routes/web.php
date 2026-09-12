<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

Route::inertia('/', 'Welcome')->name('home');
Route::inertia('login', 'auth/Login')->name('login');
Route::inertia('register', 'auth/Register')->name('register');
Route::inertia('password_forgotten', 'auth/PasswordForgotten')->name('password.forgotten');

Route::post('register', [UserController::class, 'create'])->name('register');
Route::post('login', [UserController::class, 'login'])->name('login');

Route::middleware(['auth'])->group(function () {
    Route::inertia('dashboard', 'user/Dashboard')->name('dashboard');
    Route::inertia('tasks', 'user/Tasks')->name('tasks');
    Route::inertia('dashboard/email/verify','auth/EmailVerify')->name('verification.notice');
    Route::post('logout', [UserController::class,'logout'])->name('logout');
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

Route::post('/forgot-password', function (Request $request) {

    $request->validate(['email' => 'required|email']);
    // dd($request);



    $status = Password::sendResetLink(

        $request->only('email')

    );



    return $status === Password::ResetLinkSent

        ? back()->with(['status' => __($status)])

        : back()->withErrors(['email' => __($status)]);

})->name('password.email');

Route::get('/reset-password/{token}', function (string $token) {
    // return view('auth.reset-password', ['token' => $token]);
    return Inertia::render('auth/PasswordReset', ['token'=> $token]);
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

                'password' => Hash::make($password)

            ])->setRememberToken(Str::random(60));



            $user->save();



            event(new PasswordReset($user));

        }

    );



    return $status === Password::PasswordReset

        ? redirect()->route('login')->with('status', __($status))

        : back()->withErrors(['email' => [__($status)]]);

})->middleware('guest')->name('password.update');
