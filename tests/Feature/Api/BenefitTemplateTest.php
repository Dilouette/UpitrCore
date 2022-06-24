<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\BenefitTemplate;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BenefitTemplateTest extends TestCase
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
    public function it_gets_benefit_templates_list()
    {
        $benefitTemplates = BenefitTemplate::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.benefit-templates.index'));

        $response->assertOk()->assertSee($benefitTemplates[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_benefit_template()
    {
        $data = BenefitTemplate::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(
            route('api.benefit-templates.store'),
            $data
        );

        $this->assertDatabaseHas('benefit_templates', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_benefit_template()
    {
        $benefitTemplate = BenefitTemplate::factory()->create();

        $data = [
            'name' => $this->faker->name,
            'description' => $this->faker->sentence(15),
        ];

        $response = $this->putJson(
            route('api.benefit-templates.update', $benefitTemplate),
            $data
        );

        $data['id'] = $benefitTemplate->id;

        $this->assertDatabaseHas('benefit_templates', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_benefit_template()
    {
        $benefitTemplate = BenefitTemplate::factory()->create();

        $response = $this->deleteJson(
            route('api.benefit-templates.destroy', $benefitTemplate)
        );

        $this->assertModelMissing($benefitTemplate);

        $response->assertNoContent();
    }
}
