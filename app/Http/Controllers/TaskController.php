<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    
    public function index()
    {
    
        $tasks = Task::with('user')->where(function ($query) {
            if ($userId = request('user_id')) {
                $query->where('user_id', $userId);
            }
        })->get(); 
        
        return view('tasks.index', [
            'tasks' => $tasks,
            'users' => User::all(), 
        ]);
    }

    public function create()
    {
      
        return view('tasks.create', [
            'users' => User::all(), 
        ]);
    }

    public function store(Request $request)
    {
      
        $request->validate([
            'name' => 'required|string|max:255',
            'user_id' => 'required|exists:users,id', 
        ]);
        $task = new Task();
        $task->name = $request->name;
        $task->user_id = $request->user_id; 
        $task->save();

        return redirect()->route('tasks.index');
    }

    public function show(Task $task)
    {
        $task->load('user');
        return view('tasks.show', compact('task'));
    }

    public function edit(Task $task)
    {
     
        return view('tasks.edit', [
            'task' => $task,
            'users' => User::all(), 
        ]);
    }

    public function update(Request $request, Task $task)
    {
       
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|in:' . implode(',', [Task::STATUS_TODO, Task::STATUS_IN_PROGRESS, Task::STATUS_FINISHED]),
        ]);
        $task->name = $request->name;
        $task->status = $request->status;
        $task->save();
   
        return redirect()->route('tasks.index');
    }

    public function destroy(Task $task)
    {
       
        $task->delete();
        return redirect()->route('tasks.index');
    }

    public function updateStatus(Request $request, Task $task)
    {
        $request->validate([
            'status' => 'required|in:' . implode(',', [Task::STATUS_TODO, Task::STATUS_IN_PROGRESS, Task::STATUS_FINISHED]),
        ]);

        $task->status = $request->status;
        $task->save();

        return redirect()->route('tasks.index');
    }
    
}
