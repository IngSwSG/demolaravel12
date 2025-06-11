use App\Models\Task;
use App\Models\User;

it('can toggle task status', function () {
    $user = User::factory()->create();
    $task = Task::factory()->create([
        'user_id' => $user->id,
        'status' => false,
    ]);

    $response = $this->actingAs($user)->patch(route('tasks.toggleStatus', $task));

    $response->assertRedirect(route('tasks.index'));
    expect($task->fresh()->status)->toBeTrue();
});
