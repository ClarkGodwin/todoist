<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\Register;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    public function create(Register $request)
    {
        dd($request);
    }
}
