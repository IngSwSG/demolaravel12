<?php


namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Task;
use App\Models\User;
use App\Http\Controllers\TaskController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Collection;
use Illuminate\View\View;

class TaskControllerEditTest extends TestCase
{
    use RefreshDatabase;
    public function edit_returns_edit_view_with_task_and_users()
    {

        $task = Task::factory()->create();
        $users = User::factory()->count(3)->create();

        $controller = new TaskController();
        $response = $controller->edit($task);

        $this->assertInstanceOf(View::class, $response);
        $this->assertEquals('tasks.edit', $response->name());
        $this->assertArrayHasKey('task', $response->getData());
        $this->assertArrayHasKey('users', $response->getData());
        $this->assertTrue($response->getData()['task']->is($task));
        $this->assertInstanceOf(Collection::class, $response->getData()['users']);
    }
}