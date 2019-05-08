<?php

namespace App\Http\Controllers\Admin;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateTaskRequest;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->expectsJson()){
            return response()->json([
                'data' => Task::orderBy('title')->get()
            ]);
        }
        
        return view('tasks.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTaskRequest $request)
    {
        if($file = $request->file){
            $fileName = $this->fileUpload($file);
            $request['file'] = $fileName;
        }

        Task::create($request->all());

        return response()->json([
            'data' => 'done'
        ]);
    }

    public function fileUpload($file)
    {
        // extention
        $extention = explode('/', mime_content_type($file))[1];
        // file name
        $fileName = str_random(10).'.'.$extention;
        // file
        $file = str_replace(explode(',', $file)[0].',', '', $file);
        $file = str_replace(' ', '+', $file);
        // upload file
        \File::put('uploads' .'/' . $fileName, base64_decode($file));

        return $fileName;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return response()->json([
            'data' => 'done'
        ]);
    }
}
