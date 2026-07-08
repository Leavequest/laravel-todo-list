<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChecklistController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\Api\AuthController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/me', function (Request $request) {
        return $request->user();
    });
});


Route::middleware(['auth:sanctum', 'admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return response()->json([
            'message' => 'Welcome, admin!',
            ]);
    });
});

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


Route::apiResource('checklists', ChecklistController::class);
Route::apiResource('tasks', TaskController::class);

Route::get('/checklists/{checklist}/tasks', [ChecklistController::class, 'tasks']);

Route::post('/checklists/{checklist}/tasks', [ChecklistController::class, 'addTask']);

Route::put('/tasks/{task}/toggle', [TaskController::class, 'toggle']);

Route::delete('/checklists/{checklist}/tasks', [ChecklistController::class, 'clearTasks']);
