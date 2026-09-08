<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\Login;
use App\Http\Requests\User\Register; // it is in this class that the validation logic is implemented. Laravel calls it automatically since the type of the request variable is register
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}
