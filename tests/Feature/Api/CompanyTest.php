<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Company;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CompanyTest extends TestCase
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
    public function it_gets_companies_list()
    {
        $companies = Company::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.companies.index'));

        $response->assertOk()->assertSee($companies[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_company()
    {
        $data = Company::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.companies.store'), $data);

        $this->assertDatabaseHas('companies', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_company()
    {
        $company = Company::factory()->create();

        $data = [
            'name' => $this->faker->unique->name,
            'email' => $this->faker->unique->email,
            'website' => $this->faker->text(255),
            'phone' => $this->faker->phoneNumber,
            'address' => $this->faker->address,
            'bio' => $this->faker->sentence(15),
            'logo' => $this->faker->text,
            'hiring_thumbnail' => $this->faker->text,
        ];

        $response = $this->putJson(
            route('api.companies.update', $company),
            $data
        );

        $data['id'] = $company->id;

        $this->assertDatabaseHas('companies', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_company()
    {
        $company = Company::factory()->create();

        $response = $this->deleteJson(route('api.companies.destroy', $company));

        $this->assertModelMissing($company);

        $response->assertNoContent();
    }
}
