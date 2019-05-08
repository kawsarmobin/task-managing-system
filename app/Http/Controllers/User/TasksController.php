<?php

namespace App\Http\Controllers\User;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();

        if(request()->expectsJson()){
            return response()->json([
                'data' => $user->tasks
            ]);
        }
        return view('user.task.index');
    }

    public function taskComplete(Task $task)
    {
        $task->pending = false;
        $task->fail_deadline = false;
        $task->completed = true;

        $task->save();

        return response()->json([
            'data' => 'done'
        ]);
    }
}
