<?php

namespace Tests\Feature\Order;

use App\Models\Order;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Testing\TestResponse;
use Inertia\Testing\AssertableInertia;
use Tests\TestCase;

class ListOrdersTest extends TestCase
{
    use LazilyRefreshDatabase;

    private function visitDashboard(): TestResponse
    {
        $uri = route('dashboard');

        return $this->actingAsRandomUser()->get($uri);
    }

    /** @test */
    public function it_can_see_order_list()
    {
        // Arrange
        Order::factory(5)->create();

        // Act
        $response = $this->visitDashboard();

        // Assert
        $response->assertOk();

        $response->assertInertia(fn(AssertableInertia $page) => $page
            ->component('Orders/Index')
            ->has('orders.data', 5)
        );
    }

    /** @test */
    public function it_can_see_only_today_orders()
    {
        // Arrange
        $order = Order::factory()->create();

        Order::factory()->create([
            'created_at' => now()->subDay()
        ]);

        // Act
        $response = $this->visitDashboard();

        // Assert
        $response->assertOk();

        $response->assertInertia(fn(AssertableInertia $page) => $page
            ->component('Orders/Index')
            ->has('orders.data', 1)
            ->where('orders.data.0.id', $order->id)
        );
    }

    /** @test */
    public function it_can_see_orders_with_status_pending()
    {
        // Arrange
        $order = Order::factory()->create();

        Order::factory()->completed()->create();

        // Act
        $response = $this->visitDashboard();

        // Assert
        $response->assertOk();

        $response->assertInertia(fn(AssertableInertia $page) => $page
            ->component('Orders/Index')
            ->has('orders.data', 1)
            ->where('orders.data.0.id', $order->id)
        );
    }
}