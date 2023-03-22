<?php

namespace Tests\Feature\Home;

use App\Models\Menu;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Testing\TestResponse;
use Inertia\Testing\AssertableInertia;
use Tests\TestCase;

class HomeTest extends TestCase
{
    use LazilyRefreshDatabase;

    private function mealList($data = []): TestResponse
    {
        $uri = route('home.index', $data);

        return $this->get($uri);
    }

    /** @test */
    public function it_can_see_plate_list()
    {
        // Arrange
        Menu::factory(10)->create();

        // Act
        $response = $this->mealList();

        // Assert
        $response->assertInertia(fn(AssertableInertia $page) => $page
            ->component('Home/Index')
            ->has('plates.data', 10)
        );
    }

    /** @test */
    public function it_cant_see_any_plate_if_there_is_no_availability()
    {
        // Arrange
        $plate = Menu::factory()->create(['name' => 'Pizza']);
        Menu::factory()->create(['quantity' => 0]);

        // Act
        $response = $this->mealList();

        // Assert
        $response->assertInertia(
            fn(AssertableInertia $page) => $page
                ->component('Home/Index')
                ->has('plates.data', 1)
                ->where('plates.data.0.id', $plate->id)
        );
    }
}