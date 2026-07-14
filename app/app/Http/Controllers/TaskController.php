<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Checklist;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Checklist::with('tasks')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'is_completed' => ['boolean'],
            'checklist_id' => ['required', 'exists:checklists,id'],
        ]);

        $task = Task::create($validated);

        return response()->json($task->load('checklist'), 201);
    }

    #gasa
    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        // return $task->load('checklist');
        return Inertia::render('Tasks/Show', [
            'task' => $task->load('checklist'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'name' => ['sometimes', 'required', 'string', 'max:255'],
            'is_completed' => ['sometimes', 'boolean'],
            'checklist_id' => ['sometimes', 'required', 'exists:checklists,id'],
        ]);

        $task->update($validated);

        return response()->json($task->load('checklist'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return response()->json(null, 204);
    }

    /**
     * Toggle the completion status of the specified resource.
     */
    public function toggle(Task $task)
    {
        $task->is_completed = !$task->is_completed;
        $task->save();

        return response()->json($task->load('checklist'));
    }
}
