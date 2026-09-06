<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index(Request $request, string $id)
    {
        $user = User::find($id);
        $hasTasks = $user->tasks()->count() > 0;
        $day = now()->format(date_format());
        $tasks = Task::where('user_id', '=', $user->id)
            ->where('day', '=', now)
            ->get();

        return Inertia::render('user/Dashboard', compact('user', 'hasTasks', 'tasks'));
    }
}
