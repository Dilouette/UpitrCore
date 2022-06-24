<?php

namespace Tests\Feature\Api;

use App\Models\User;

use App\Models\Department;
use App\Models\Designation;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_gets_users_list()
    {
        $users = User::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.users.index'));

        $response->assertOk()->assertSee($users[0]->email);
    }

    /**
     * @test
     */
    public function it_stores_the_user()
    {
        $data = User::factory()
            ->make()
            ->toArray();
        $data['password'] = \Str::random('8');

        $response = $this->postJson(route('api.users.store'), $data);

        unset($data['password']);
        unset($data['email_verified_at']);
        unset($data['is_active']);

        $this->assertDatabaseHas('users', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_user()
    {
        $user = User::factory()->create();

        $designation = Designation::factory()->create();
        $department = Department::factory()->create();

        $data = [
            'email' => $this->faker->unique->email,
            'username' => $this->faker->name,
            'firstname' => $this->faker->text(255),
            'lastname' => $this->faker->lastName,
            'department_id' => $this->faker->randomNumber(0),
            'reset_login' => $this->faker->boolean,
            'first_login' => $this->faker->boolean,
            'last_login' => $this->faker->dateTime,
            'designation_id' => $this->faker->randomNumber(0),
            'is_active' => $this->faker->boolean,
            'designation_id' => $designation->id,
            'department_id' => $department->id,
        ];

        $data['password'] = \Str::random('8');

        $response = $this->putJson(route('api.users.update', $user), $data);

        unset($data['password']);
        unset($data['email_verified_at']);
        unset($data['is_active']);

        $data['id'] = $user->id;

        $this->assertDatabaseHas('users', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_user()
    {
        $user = User::factory()->create();

        $response = $this->deleteJson(route('api.users.destroy', $user));

        $this->assertModelMissing($user);

        $response->assertNoContent();
    }
}
