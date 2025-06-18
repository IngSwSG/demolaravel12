<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;
use App\Models\Post;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $user1 = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $user2 = User::factory()->create([
            'name' => 'Another User',
            'email' => 'another@example.com',
        ]);

        Task::factory(5)->create([
            'user_id' => $user1->id, // Assign tasks to the first user created
        ]);

        Task::factory(15)->create([
            'user_id' => $user2->id, // Assign tasks to the second user created
        ]);


        $user = User::factory()->create();
        $post = Post::factory()->create();
        $post->like();
    }
}
