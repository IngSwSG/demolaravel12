<?php
use App\Models\Team;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

it('un equipo puede agrear usuarios', function(){
    $team = Team::factory()->create();
    $user1 = User::factory()->create();
    $user2 = User::factory()->create();

    $team->add($user1);
    $team->add($user2);

    expect($team->users)->count()->toBe(2);
});

it('un equipo puede tener un tamaño maximo', function(){
    $team = Team::factory()->create(['size' => 2]);
    $user1 = User::factory()->create();
    $user2 = User::factory()->create();
    
    $team->add($user1);
    $team->add($user2);

    expect($team->users)->count()->toBe(2);

    $this->expectException(Exception::class);
    $user3 = User::factory()->create();
    $team->add($user3);


});

it('un equipo puede agregar multiples usuarios a la vez', function(){
    $team = Team::factory()->create(['size' => 3]);
    $users = User::factory(3)->create();

    $team->add($users);

    expect($team->users)->count()->toBe(3);
});


class TeamsTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    public function test_team_creation_validates_required_fields()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->postJson('/api/teams', [
            'description' => 'Test team description',
        ]);

        $response->assertStatus(422)
                ->assertJsonValidationErrors(['name']);
    }

    public function test_team_creation_validates_name_length()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->postJson('/api/teams', [
            'name' => 'a', // Solo 1 carácter
            'description' => 'Test description'
        ]);

        $response->assertStatus(422)
                ->assertJsonValidationErrors(['name']);
    }

    public function test_team_creation_success_with_valid_data()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $teamData = [
            'name' => 'Test Team',
            'description' => 'A test team description'
        ];

        $response = $this->postJson('/api/teams', $teamData);

        $response->assertStatus(201)
                ->assertJsonStructure([
                    'data' => [
                        'id',
                        'name',
                        'description',
                        'created_at',
                        'updated_at'
                    ]
                ]);

        $this->assertDatabaseHas('teams', [
            'name' => $teamData['name'],
            'description' => $teamData['description']
        ]);
    }

}

it('no puede agregar múltiples usuarios si excede el límite', function(){
    $team = Team::factory()->create(['size' => 2]);
    $users = User::factory(3)->create();
    
    expect(fn() => $team->add($users))->toThrow(Exception::class);
    expect($team->fresh()->users)->count()->toBe(0);
    //PRUEBA 2
});