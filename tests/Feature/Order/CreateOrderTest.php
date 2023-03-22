<?php

namespace Tests\Feature\Order;

use App\Events\UpdateOrdersEvent;
use App\Models\Menu;
use App\Models\MenuOrder;
use App\Models\Order;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class CreateOrderTest extends TestCase
{
    use LazilyRefreshDatabase;

    private function createOrder($data = []): TestResponse
    {
        $uri = route('orders.store');

        return $this->post($uri, $data);
    }

    protected function setUp(): void
    {
        parent::setUp();
        Event::fake();
    }

    /** @test */
    public function it_can_create_a_order_with_several_foods() {
        // Arrange
        $plateOne = Menu::factory()->create([
            'quantity' => $plateOneQuantity = 2,
        ]);

        $plateTwo = Menu::factory()->create([
            'quantity' => $plateTwoQuantity = 1,
        ]);

        // Act
        $response = $this->createOrder([
            'ordersId' => [
                [
                    'orderId' => $plateOne->id,
                    'quantity' => 2,
                ],
                [
                    'orderId' => $plateTwo->id,
                    'quantity' => 1,
                ],
            ],
            'client_name' => $clientName = 'Client Name',
            'table_number' => $tableNumber = 1,
        ]);

        // Assert
        Event::assertDispatched(UpdateOrdersEvent::class);

        $response->assertRedirect(route('home.index'));
        $response->assertSessionHas('flash_success', 'Su pedido se realizó con éxito');

        $this->assertCount(1, Order::all());
        $this->assertCount(2, MenuOrder::all());

        $this->assertEquals(0, $plateOne->fresh()->quantity);
        $this->assertEquals(0, $plateTwo->fresh()->quantity);

        $order = Order::first();
        $this->assertCount(2, $order->foods);

        $menuOrderOne = MenuOrder::first();
        $this->assertEquals($order->id, $menuOrderOne->order_id);
        $this->assertEquals(2, $menuOrderOne->quantity);

        $menuOrderTwo = MenuOrder::all()->last();
        $this->assertEquals($order->id, $menuOrderTwo->order_id);
        $this->assertEquals(1, $menuOrderTwo->quantity);

        $this->assertEquals($clientName, $order->client_name);
        $this->assertEquals($tableNumber, $order->table_number);
    }

    /** @test */
    public function it_cannot_create_a_order_if_a_menu_it_is_not_available() {
        // Arrange
        $plateOne = Menu::factory()->create([
            'quantity' => 0,
        ]);

        $plateTwo = Menu::factory()->create([
            'quantity' => 2,
        ]);

        // Act
        $response = $this->createOrder([
            'ordersId' => [
                [
                    'orderId' => $plateOne->id,
                    'quantity' => 1,
                ],
                [
                    'orderId' => $plateTwo->id,
                    'quantity' => 1,
                ]
            ],
            'client_name' => $clientName = 'Client Name',
            'table_number' => $tableNumber = 1,
        ]);

        // Assert
        $response->assertRedirect(route('home.index'));
        $response->assertSessionHas('flash_warning', "El siguiente menú ya no se encuentra disponible: $plateOne->name");

        $this->assertCount(0, Order::all());
        $this->assertCount(0, MenuOrder::all());

        $this->assertEquals(0, $plateOne->fresh()->quantity);
        $this->assertEquals(2, $plateTwo->fresh()->quantity);
    }

    /** @test */
    public function fields_are_required() {
        // Arrange
        $plateOne = Menu::factory()->create();
        $plateTwo = Menu::factory()->create();

        // Act
        $response = $this->createOrder([
            'ordersId' => [
                [
                    'orderId' => $plateOne->id,
                    'quantity' => 2,
                ],
                [
                    'orderId' => $plateTwo->id,
                    'quantity' => 1,
                ],
            ],
            'client_name' => null,
            'table_number' => null,
        ]);

        // Assert
        $response->assertSessionHasErrors([
            'client_name',
            'table_number',
        ]);
    }
}