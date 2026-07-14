<?php

namespace App\Http\Controllers;

use App\Models\Checklist;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ChecklistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Checklist::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
        ]);

        $checklist = Checklist::create($validated);

        return response()->json($checklist, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Checklist $checklist)
    {
        // return $checklist->load(['tasks']);
        return Inertia::render('Checklists/Show', [
            'checklist' => $checklist->load(['tasks']),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Checklist $checklist)
    {
        $validated = $request->validate([
            'name' => ['sometimes','required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
        ]);

        $checklist->update($validated);

        return response()->json($checklist);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Checklist $checklist)
    {
        $checklist->delete();
        return response()->json(null, 204);
    }

    public function tasks(Checklist $checklist)
    {
        return $checklist->tasks;
    }

    public function clearTasks(Checklist $checklist)
    {
        $checklist->tasks()->delete();
        return response()->json(null, 204);
    }

    public function addTask(Request $request, Checklist $checklist)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'is_completed' => ['boolean'],
        ]);

        $task = $checklist->tasks()->create($validated);

        return response()->json($task, 201);
    }
}
