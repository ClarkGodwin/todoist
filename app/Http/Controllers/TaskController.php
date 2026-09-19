<?php

namespace App\Http\Controllers;

use App\Enums\TaskStatus;
use App\Http\Requests\Task\CreateTask;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function view()
    {
        $tasks = Task::where("user_id", auth()->user()->id)
        ->where("day", now()->toDateString())
        ->select(['id', 'title', 'description', 'status', 'day'])
        ->get();

        return Inertia::render('tasks/Tasks', compact('tasks'));
    }

    public function viewTaskForm(Request $request){
        $day = $request->day;
        return Inertia::render('tasks/CreateTaskForm', compact('day'));
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
        return redirect()->route('tasks');
    }

    function switchTaskStatus(Request $request){
        $task = Task::find($request->task_id);
        $task->status = $task->status == TaskStatus::ToDo ? TaskStatus::Done : TaskStatus::ToDo;
        $task->save();

        return back();
    }

    public function updateTaskForm(Request $request){
        $task = Task::find($request->id);
        return Inertia::render('tasks/UpdateTaskForm', compact('task'));
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
