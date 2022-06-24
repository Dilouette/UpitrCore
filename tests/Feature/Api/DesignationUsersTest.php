<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Designation;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DesignationUsersTest extends TestCase
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
    public function it_gets_designation_users()
    {
        $designation = Designation::factory()->create();
        $users = User::factory()
            ->count(2)
            ->create([
                'designation_id' => $designation->id,
            ]);

        $response = $this->getJson(
            route('api.designations.users.index', $designation)
        );

        $response->assertOk()->assertSee($users[0]->email);
    }

    /**
     * @test
     */
    public function it_stores_the_designation_users()
    {
        $designation = Designation::factory()->create();
        $data = User::factory()
            ->make([
                'designation_id' => $designation->id,
            ])
            ->toArray();
        $data['password'] = \Str::random('8');

        $response = $this->postJson(
            route('api.designations.users.store', $designation),
            $data
        );

        unset($data['password']);
        unset($data['email_verified_at']);
        unset($data['is_active']);

        $this->assertDatabaseHas('users', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $user = User::latest('id')->first();

        $this->assertEquals($designation->id, $user->designation_id);
    }
}
