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
        $itemTestId = 1;
        $response = $this->get('/api/items/'.$itemTestId);

        $response->assertStatus(200);
    }

    /**
     * Test if an item is posted correctly
     *
     * @return void
     */
    public function testItemPostRequest()
    {
        $itemTestName = 'Tennis ball';

        $response = $this->postJson('/api/items', ['name' => $itemTestName]);

        $response
            ->assertStatus(201)
            ->assertJson([
                'name' => $itemTestName,
            ]);
    }

    public function testItemUpdateRequest()
    {
        $itemTestName = 'Cricket ball';
        $itemTestId = 1;

        $response = $this->putJson('/api/items/'.$itemTestId, ['name' => $itemTestName]);

        $response
            ->assertStatus(200)
            ->assertJson([
                'name' => $itemTestName,
            ]);
    }

    public function testItemDeleteRequest()
    {
        $itemTestId = 3;

        $response = $this->deleteJson('/api/items/'.$itemTestId);

        $response->assertStatus(204);
    }
}
