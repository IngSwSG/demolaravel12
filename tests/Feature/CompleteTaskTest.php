<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CompleteTaskTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_mark_task_as_in_process_and_complete()
    {
        $user = User::factory()->create();

        // Crear tarea en pendiente (0)
        $task = Task::factory()->create([
            'user_id' => $user->id,
            'completed' => 0,
        ]);

        // Marcar como EN PROCESO (1)
        $responseInProcess = $this->actingAs($user)->patch(
            route('tasks.complete', ['id' => $task->id, 'state' => 1])
        );

        $responseInProcess->assertRedirect(route('tasks.index'));
        $this->assertEquals(1, Task::find($task->id)->completed);

        // Marcar como COMPLETADA (2)
        $responseComplete = $this->actingAs($user)->patch(
            route('tasks.complete', ['id' => $task->id, 'state' => 2])
        );

        $responseComplete->assertRedirect(route('tasks.index'));
        $this->assertEquals(2, Task::find($task->id)->completed);
    }
}
