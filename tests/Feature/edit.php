<?php

use App\Models\Task;
use App\Models\User;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('returns edit view with task and users', function () {

    $task = Task::factory()->create();
    $users = User::factory()->count(3)->create();


    $controller = new TaskController();
    $response = $controller->edit($task);


    expect($response)->toBeInstanceOf(View::class)
        ->and($response->name())->toBe('tasks.edit')
        ->and($response->getData())->toHaveKeys(['task', 'users'])
        ->and($response->getData()['task']->is($task))->toBeTrue()
        ->and($response->getData()['users'])->toBeInstanceOf(Collection::class);
});