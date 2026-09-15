<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\Login;
use App\Http\Requests\User\Register; // it is in this class that the validation logic is implemented. Laravel calls it automatically since the type of the request variable is register
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Inertia\Inertia;

class UserController extends Controller
{
    public function create(Register $request)
    {
        // put the newly created User in the $user variable
        $user = User::create($request->validated());

        // this event is used to inform that a new user has been created so that a verification email is automatically sent
        event(new Registered($user));

        Auth::login($user, $remember = true);
        $request->session()->regenerate();

        return redirect()->intended(route('verification.notice'));
    }

    public function login(Login $request)
    {
        if (Auth::attempt($request->validated(), true)) {
            $request->session()->regenerate();

            return redirect()->intended(route('dashboard'));
        } else {
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ])->onlyInput('email');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->intended(route('home'));
    }

    public function sendEmailVerificationLink(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();

        Inertia::flash('success', 'Verification link sent!');

        return back();

    }

    public function verifyTheEmail(EmailVerificationRequest $request)
    {
        $request->fulfill();

        return redirect()->intended(route('dashboard'));
    }

    public function sendEmailToResetThePassword(Request $request)
    {
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

    }

    public function renderPasswordResetForm(Request $request, string $token)
    {
        return Inertia::render('auth/PasswordReset', [
            'token' => $token,
            'email' => $request->email,
        ]);
    }

    public function resetThePassword(Request $request)
    {

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

        if ($status === Password::PasswordReset) {
            Inertia::flash('status', __($status));

            return redirect()->route('login');
        }

        return back()->withErrors([
            'email' => [__($status)],
        ]);
    }
}
