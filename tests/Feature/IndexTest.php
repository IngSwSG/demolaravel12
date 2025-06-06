<?php
namespace Tests\Feature;

use App\Models\User;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('shows every task when no filter is provided', function () {
    $users = User::factory()->count(5)->create();

    $tasks = Task::factory()
        ->count(5)
        ->sequence(
            ['user_id' => $users[0]->id],
            ['user_id' => $users[1]->id],
            ['user_id' => $users[2]->id],
            ['user_id' => $users[3]->id],
            ['user_id' => $users[4]->id],
        )
        ->create();

    $response = $this->get(route('tasks.index'));

    $response->assertOk()
        ->assertViewIs('tasks.index')
        ->assertViewHas(
            'tasks',
            fn($viewTasks) =>
            $viewTasks->count() === $tasks->count()
        );
});


it('filters tasks by user', function () {
    [$owner, $otherUser] = User::factory()->count(2)->create();

    $expectedTask = Task::factory()->create(['user_id' => $owner->id]);
    Task::factory()->count(2)->create(['user_id' => $otherUser->id]);

    $response = $this->get(route('tasks.index', ['user_id' => $owner->id]));

    $response->assertOk()
        ->assertViewHas(
            'tasks',
            fn($viewTasks) =>
            $viewTasks->count() === 1 &&
            $viewTasks->first()->is($expectedTask)
        );
});