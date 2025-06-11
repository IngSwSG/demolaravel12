<?php

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

// Test: Alternar estado de tarea de incompleta a completa
it('toggles task from incomplete to complete', function () {
    $user = User::factory()->create();
    $task = Task::factory()->create([
        'user_id' => $user->id,
        'completed' => false,
    ]);

    $this->actingAs($user)
        ->patch(route('tasks.toggle-complete', $task->id))
        ->assertRedirect(route('tasks.index'));

    $this->assertTrue($task->fresh()->completed);
});

// Test: Alternar estado de tarea de completa a incompleta
it('toggles task from complete to incomplete', function () {
    $user = User::factory()->create();
    $task = Task::factory()->create([
        'user_id' => $user->id,
        'completed' => true,
    ]);

    $this->actingAs($user)
        ->patch(route('tasks.toggle-complete', $task->id))
        ->assertRedirect(route('tasks.index'));

    $this->assertFalse($task->fresh()->completed);
});

