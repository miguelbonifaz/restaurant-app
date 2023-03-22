<?php

namespace Tests\Feature\Order;

use App\Models\Order;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Tests\TestCase;

class FinalizeOrderTest extends TestCase
{
    use LazilyRefreshDatabase;

    /** @test */
    public function it_can_finalize_a_order()
    {
        // Arrange
        $order = Order::factory()->create();

        $uri = route('orders.finalize', $order);

        // Act
        $response = $this->actingAsRandomUser()->post($uri);

        // Assert
        $response->assertRedirect(route('dashboard'));

        $response->assertSessionHas('message', "La Order #$order->id ha sido finalizada");

        $this->assertTrue($order->fresh()->isFinalized());
    }
}