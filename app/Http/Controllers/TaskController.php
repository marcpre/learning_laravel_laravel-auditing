<?php

namespace App\Http\Controllers;

use App\Task;
use Debugbar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class TaskController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::orderBy('id', 'desc')->paginate(7);
        return view('tasks.index')->with('storedTasks', $tasks);
        // $tasks = Task::orderBy('id', 'desc')->paginate(7);
        // return view('tasks.index')->with('storedTasks', $tasks);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'newTaskName' => 'required|min:3|max:190',
        ]);

        $task = new Task;
        $task->name = $request->newTaskName;

        $task->save();
        Session::flash('success', 'New task has been successfully added.');

        return redirect()->route('tasks.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        return view('tasks.edit')->with('taskUnderEdit', $task);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        $this->validate($request, [
            'updatedTaskName' => 'required|min:3|max:190',
        ]);

        $task->name = $request->updatedTaskName;
 
        $task->save();
        Session::flash('success', 'Task #' . $task->id . ' has been successfully updated.');

        return redirect()->route('tasks.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();

        Session::flash('success', 'Task #' . $task->id . ' has been successfully deleted.');

        return redirect()->route('tasks.index');
    }
}
