<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Carbon\Carbon;

class TodoAppController extends Controller
{
    public function completeTask($id)
{
    $task = Task::findOrFail($id);

    if ($task->expires_at && Carbon::parse($task->expires_at)->isPast()) {
        return redirect()->back()->with('error', 'Task is already expired.');
    }

    $task->completed = true;
    $task->completed_at = now();
    $task->save();

    return redirect()->back()->with('success', 'Task marked as complete.');
}

    public function showTasks(){
        $tasks = Task::get();

        return view('tasks', compact('tasks'));

    }
    
    public function taskEntryForm(){
        return view('create-task');

    }

    public function createTask(Request $request){
        $task=new Task();
        $task->title=$request->title;
        $task->expires_at = $request->expires_at;
        $task->save();
        return redirect()->route('tasks');
    }

    public function deleteTask($id){
        $task = Task::where('id', $id)->first();
        $task->delete();
        return redirect()->route('tasks');
    }

}
