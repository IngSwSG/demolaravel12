<?php

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\get;

uses(RefreshDatabase::class);

test('puede mostrar una tarea individual', function () {
    $task = Task::factory()->create();

    $response = get("/tasks/{$task->id}");

    $response->assertStatus(200);
    $response->assertViewIs('tasks.show');
    $response->assertViewHas('task', fn ($viewTask) => $viewTask->id === $task->id);
});
