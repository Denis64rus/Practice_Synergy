<?php
namespace App\Http\Controllers;
use App\Models\Task;
use App\Events\TaskCreated;
use App\Events\TaskUpdated;
use Illuminate\Http\Request;
class TaskController extends Controller {
    public function index() {
        return Task::all();
    }
    public function store(Request $request) {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
        $task = $request->user()->tasks()->create($validatedData);
        broadcast(new TaskCreated($task))->toOthers();
        return $task;
    }
    public function update(Request $request, Task $task) {
        $validatedData = $request->validate([
            'status' => 'required|in:todo,in_progress,done',
        ]);
        $task->update($validatedData);
        broadcast(new TaskUpdated($task))->toOthers();
        return $task;
    }
}