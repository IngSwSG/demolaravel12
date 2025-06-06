<?php

use App\Models\User;
use App\Models\Task;
use function Pest\Laravel\delete;
use function Pest\Laravel\route;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(Tests\TestCase::class, RefreshDatabase::class);

test('destroy deletes task and redirects', function () {
    $user = User::factory()->create();
    $task = Task::factory()->create([
        'user_id' => $user->id,
    ]);

    $response = delete(route('tasks.destroy', $task));

    $response->assertRedirect(route('tasks.index'));

    $this->assertDatabaseMissing('tasks', [
        'id' => $task->id,
    ]);
});
