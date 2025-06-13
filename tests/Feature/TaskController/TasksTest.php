<?php

use App\Models\Task;
use App\Models\User;

it('can update task status', function () {
    $user = User::factory()->create();

    $task = Task::factory()->create([
        'user_id' => $user->id,
        'status' => Task::STATUS_TODO,
    ]);

    $response = $this->actingAs($user)->patch(route('tasks.status', $task), [
        'status' => Task::STATUS_IN_PROGRESS,
    ]);

    $response->assertRedirect(route('tasks.index'));

    expect($task->fresh()->status)->toBe(Task::STATUS_IN_PROGRESS);
});
