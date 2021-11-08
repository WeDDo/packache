<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrderTest extends TestCase
{
    public function testOrderIndexRequest()
    {
        $response = $this->get('/api/orders');

        $response->assertStatus(200);
    }

    public function testOrderReadRequest()
    {
        $orderId = 1;
        $response = $this->get('/api/orders/'.$orderId);

        $response->assertStatus(200);
    }

    public function testOrderPostRequest()
    {
        $orderRecipient = 'Iki';

        $response = $this->postJson('/api/orders', ['recipient' => $orderRecipient]);

        $response
            ->assertStatus(201)
            ->assertJson([
                'recipient' => $orderRecipient,
            ]);
    }

    public function testOrderUpdateRequest()
    {
        $orderRecipient = 'Majai';
        $orderId = 5;

        $response = $this->putJson('/api/orders/'.$orderId, ['recipient' => $orderRecipient]);

        $response
            ->assertStatus(200)
            ->assertJson([
                'recipient' => $orderRecipient,
            ]);
    }

    public function testOrderDeleteRequest()
    {
        $orderId = 10;

        $response = $this->deleteJson('/api/orders/'.$orderId);

        $response->assertStatus(204);
    }
}
