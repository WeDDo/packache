<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ItemTest extends TestCase
{
    /**
     * Test if item index request works.
     *
     * @return void
     */
    public function testItemIndexRequest()
    {
        $response = $this->get('/api/items');

        $response->assertStatus(200);
    }

    public function testItemReadRequest()
    {
        $itemId = 5;
        $response = $this->get('/api/items/'.$itemId);

        $response->assertStatus(200);
    }

    /**
     * Test if an item is posted correctly
     *
     * @return void
     */
    public function testItemPostRequest()
    {
        $itemName = 'Tennis ball';

        $response = $this->postJson('/api/items', ['name' => $itemName]);

        $response
            ->assertStatus(201)
            ->assertJson([
                'name' => $itemName,
            ]);
    }

    public function testItemUpdateRequest()
    {
        $itemName = 'Pencil';
        $itemId = 6;

        $response = $this->putJson('/api/items/'.$itemId, ['name' => $itemName]);

        $response
            ->assertStatus(200)
            ->assertJson([
                'name' => $itemName,
            ]);
    }

    public function testItemDeleteRequest()
    {
        $itemId = 7;

        $response = $this->deleteJson('/api/items/'.$itemId);

        $response->assertStatus(204);
    }
}
