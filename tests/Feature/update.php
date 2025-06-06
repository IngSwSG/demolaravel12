<?php

namespace Tests\Feature;
use App\Models\User;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('a task can be updated successfully', function () {
    // Crear un usuario y una tarea
    $user = User::factory()->create();
    $task = Task::factory()->create([
        'name' => 'Tarea original',
        'user_id' => $user->id,
    ]);

    // Nuevos datos
    $data = [
        'name' => 'Tarea actualizada',
    ];

    // Enviar petición PUT
    $response = $this->put("/tasks/{$task->id}", $data);

    // Verificar redirección
    $response->assertRedirect(route('tasks.index'));

    // Confirmar que se actualizó en la base de datos
    $this->assertDatabaseHas('tasks', [
        'id' => $task->id,
        'name' => 'Tarea actualizada',
    ]);
});