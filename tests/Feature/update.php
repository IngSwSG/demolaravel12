<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;

class update extends TestCase
{
    use RefreshDatabase;


    public function it_updates_a_task_successfully()
    {
        $user = User::factory()->create();
        $task = Task::factory()->create([
            'name' => 'Old Name',
            'user_id' => $user->id,
        ]);

        $response = $this->put(route('tasks.update', $task), [
            'name' => 'New Name',
        ]);
        $response->assertRedirect(route('tasks.index'));
        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'name' => 'New Name',
        ]);
    }
}