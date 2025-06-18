<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('tasks', TaskController::class);

Route::middleware('auth')->group(function () {
    Route::post   ('posts/{post}/like', [LikeController::class, 'store']);
    Route::delete ('posts/{post}/like', [LikeController::class, 'destroy']);
});

