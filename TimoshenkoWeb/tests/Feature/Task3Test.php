<?php

namespace Tests\Feature;

use App\Models\Employer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Http\Response;
use Tests\TestCase;

class Task3Test extends TestCase
{
    use WithoutMiddleware, RefreshDatabase;

    protected $modelFields = [
        "name",
        "address",
        "card_code"
    ];
    protected $modelClass = Employer::class;
    protected $modelPluralName = "employers";
    protected $modelSingleName = "employer";

    /* Checks json pagination */
    public function testIndex()
    {
        Employer::factory()->count(50)->create();
        $per_page = rand(5, 15);
        $routeName = $this->modelPluralName . ".index";
        $response = $this->getJson(route($routeName, ['per_page' => $per_page]));
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure(["meta", "links", "data" => [$this->modelFields]]);
        $responseContent = $response->json();
        $this->assertCount($per_page, $responseContent["data"]);
        $this->assertEquals(50, $responseContent["meta"]["total"]);
    }

    /* Checks model creating */
    public function testCreate()
    {
        $routeName = $this->modelPluralName . "_create";
        $response = $this->get(route($routeName));
        $response->assertViewIs($routeName);
        $response->assertSee($this->modelPluralName . " form");
    }

    /* Checks model saving */
    public function testStoreOk()
    {
        $data = Employer::factory()->make()->toArray();
        $routeName = $this->modelPluralName . ".store";
        $redirectRouteName = $this->modelPluralName . ".show";
        $response = $this->post(route($routeName), $data);
        $response->assertRedirect(route($redirectRouteName, [$this->modelSingleName => 1]));
    }

    /* Checks saving validation */
    public function testStoreError()
    {
        $routeName = $this->modelPluralName . ".store";
        $response = $this->post(route($routeName), []);
        $response->assertStatus(Response::HTTP_FOUND);
        //$response->assertSessionHasErrors($this->modelFields);
    }
}
