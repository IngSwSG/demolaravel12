<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('tasks.index');
});

Route::resource('tasks', TaskController::class);
<<<<<<< HEAD

Route::middleware('auth')->group(function () {
    Route::post('/posts/{post}/like', [LikeController::class, 'store']);
    Route::delete('/posts/{post}/like', [LikeController::class, 'destroy']);
    Route::put('/posts/{post}/like', [LikeController::class, 'toggle']);
});
=======
Route::patch('tasks/{task}/toggle-completed', [TaskController::class, 'toggleCompleted'])
     ->name('tasks.toggle-completed');
>>>>>>> f58dacc72a36c8e0130a2b83c135e0bfa0743d1d
