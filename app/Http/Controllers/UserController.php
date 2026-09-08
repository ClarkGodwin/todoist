<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\Register;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class UserController extends Controller
{
    public function create(Register $request)
    {
        $user = User::create($request->validated());
        Auth::login($user);
        return to_route('dashboard');
    }
}
