<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('tasks', TaskController::class);

Route::patch('/tasks/{id}/complete', [TaskController::class, 'complete'])->name('tasks.complete');
