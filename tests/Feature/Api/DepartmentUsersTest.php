<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Department;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DepartmentUsersTest extends TestCase
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
    public function it_gets_department_users()
    {
        $department = Department::factory()->create();
        $users = User::factory()
            ->count(2)
            ->create([
                'department_id' => $department->id,
            ]);

        $response = $this->getJson(
            route('api.departments.users.index', $department)
        );

        $response->assertOk()->assertSee($users[0]->email);
    }

    /**
     * @test
     */
    public function it_stores_the_department_users()
    {
        $department = Department::factory()->create();
        $data = User::factory()
            ->make([
                'department_id' => $department->id,
            ])
            ->toArray();
        $data['password'] = \Str::random('8');

        $response = $this->postJson(
            route('api.departments.users.store', $department),
            $data
        );

        unset($data['password']);
        unset($data['email_verified_at']);
        unset($data['is_active']);

        $this->assertDatabaseHas('users', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $user = User::latest('id')->first();

        $this->assertEquals($department->id, $user->department_id);
    }
}
