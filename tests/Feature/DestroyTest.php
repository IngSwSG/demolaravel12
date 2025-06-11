<?php

use App\Models\User;
use App\Models\Task;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\delete;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('a user can delete their task', function () {
    $user = User::factory()->create();
    $task = Task::factory()->create([
        'user_id' => $user->id,
    ]);

    actingAs($user);

    $response = delete(route('tasks.destroy', $task->id));

    $response->assertRedirect(route('tasks.index'));

    expect(Task::find($task->id))->toBeNull();
});



