<?php

/**
 * 1. Simple user manipulation: create, update, login, logout
 * 2. Email verification link functioon
 * 3. Password reset functions
 */

namespace App\Http\Controllers;

// it is in this class that the validation for the $request with each of these 2 types is implemented. Laravel calls it automatically since the type of the request variable is Login or Register
use App\Http\Requests\User\Login;
use App\Http\Requests\User\ModifyAccountInfo;
use App\Http\Requests\User\ModifyPassword;
use App\Http\Requests\User\Register;
use App\Models\Task;
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
    // ========================1. Simple user manipulation=====================
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

    public function updateUserInfo(ModifyAccountInfo $request)
    {
        $user = Auth::user();

        // to check if the user has changed his email so that a new email verification link will be sent to him so that we can be sure that the email is really his
        if ($user->email != $request->input('email')) {
            $user->update($request->validated());

            // since the previous email has to have been registered to reach this point, the email_verified_at column has to be put at null so that the user has no access to the middelware('verified') routes unless he verifies his new email
            $user->email_verified_at = null;

            $user->save();

            //this event is triggered so that a  email verification link is sent to the user
            event(new Registered($user));

            return redirect()->intended(route('verification.notice'));

        } else {
            $user->update($request->validated());
            $user->save();
            Inertia::flash('success', 'Your modifications have been registered');

            return redirect()->intended(route('account'));
        }
    }

    public function updatePassword(ModifyPassword $request){
        $user = Auth::user();

        if(Hash::check($request->input('old_password'), $user->password)){
            $user->password = Hash::make($request->input('password'));
            $user->save();
            Inertia::flash('success','The password has been updated');
            return redirect()->intended(route('account'));
        }
        else{
            return back()->withErrors([
                'old_password'=> 'The old password is incorrect'
            ]);
        }
    }

    public function deleteUser(Request $request){
        $tasks = Task::where('user_id', Auth::user()->id)->get();
        Task::destroy($tasks);

        User::destroy(Auth::user()->id);

        Inertia::flash('success','Your account has been successfully deleted');

        return redirect()->intended(route('home'));
    }

    // ========================2. Email verification link=====================

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

    // ========================3. Password  Reset=====================

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
