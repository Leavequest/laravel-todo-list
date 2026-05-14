<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChecklistController;
use App\Http\Controllers\TaskController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::apiResource('checklists', ChecklistController::class);
Route::apiResource('tasks', TaskController::class);

Route::get('/checklists/{checklist}/tasks', [ChecklistController::class, 'tasks']);

Route::post('/tasks/{task}/toggle', [TaskController::class, 'toggle']);

Route::delete('/checklists/{checklist}/tasks', [ChecklistController::class, 'clearTasks']);
