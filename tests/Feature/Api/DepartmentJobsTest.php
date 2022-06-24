<?php

namespace Tests\Feature\Api;

use App\Models\Job;
use App\Models\User;
use App\Models\Department;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DepartmentJobsTest extends TestCase
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
    public function it_gets_department_jobs()
    {
        $department = Department::factory()->create();
        $jobs = Job::factory()
            ->count(2)
            ->create([
                'department_id' => $department->id,
            ]);

        $response = $this->getJson(
            route('api.departments.jobs.index', $department)
        );

        $response->assertOk()->assertSee($jobs[0]->title);
    }

    /**
     * @test
     */
    public function it_stores_the_department_jobs()
    {
        $department = Department::factory()->create();
        $data = Job::factory()
            ->make([
                'department_id' => $department->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.departments.jobs.store', $department),
            $data
        );

        $this->assertDatabaseHas('jobs', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $job = Job::latest('id')->first();

        $this->assertEquals($department->id, $job->department_id);
    }
}
