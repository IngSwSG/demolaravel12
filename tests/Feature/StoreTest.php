<?php

use App\Models\User;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('a task can be created successfully', function () {
    // Crear un usuario de prueba
    $user = User::factory()->create();

    // Datos válidos para la tarea
    $data = [
        'name' => 'Nueva tarea',
        'user_id' => $user->id,
    ];

    // Enviar petición POST
    $response = $this->post('/tasks', $data);

    // Asegurarse de que redirige correctamente
    $response->assertRedirect(route('tasks.index'));

    // Comprobar que se guardó la tarea en la base de datos
    $this->assertDatabaseHas('tasks', [
        'name' => 'Nueva tarea',
        'user_id' => $user->id,
    ]);
});
