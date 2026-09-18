<?php

namespace App\Http\Controllers;

use App\Http\Requests\Task\CreateTask;
use App\Models\Task;
use App\Models\User;
use Inertia\Inertia;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function view()
    {
        $tasks = Task::where("user_id", auth()->user()->id)
        ->select(['id', 'title', 'description', 'status', 'day'])->get();

        return Inertia::render('tasks/Tasks', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(CreateTask $request)
    {
        if($request->day == null){
            $request->day = now()->toDateString();
        }
        $task = Task::create([
            'user_id'=> auth()->user()->id,
            'title'=> $request->title,
            'description'=> $request->description,
            'day'=> $request->day,
        ]);
        Inertia::flash('success','Task created');
        return back();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        //
    }
}
