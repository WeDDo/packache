<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;
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
        $user = User::factory()->make(
            ['password' => bcrypt($password = 'i-love-laravel'),
            'role' => 'employee']);
        Passport::actingAs($user);

        $token = $user->createToken('Personal Access Token');
        $accessToken = $token->accessToken;
        $headers = ['Authorization' => 'Bearer'.$accessToken];

        $response = $this->get('/api/items', $headers);

        $response->assertStatus(200);
    }

    /**
     * @dataProvider dataProviderGET
     */
    public function testItemReadRequest($itemId, $expectedCode)
    {
        $user = User::factory()->make(
            ['password' => bcrypt($password = 'i-love-laravel'),
            'role' => 'employee']);
        Passport::actingAs($user);

        $token = $user->createToken('Personal Access Token');
        $accessToken = $token->accessToken;
        $headers = ['Authorization' => 'Bearer'.$accessToken];

        $response = $this->get('/api/items/'.$itemId, $headers);

        $response->assertStatus($expectedCode);
    }

    /**
     * @dataProvider dataProviderPOST
     */
    public function testItemPostRequest($itemName, $expectedCode)
    {
        $user = User::factory()->make(
            ['password' => bcrypt($password = 'i-love-laravel'),
            'role' => 'admin']);
        Passport::actingAs($user);

        $token = $user->createToken('Personal Access Token');
        $accessToken = $token->accessToken;
        $headers = ['Authorization' => 'Bearer'.$accessToken];

        $response = $this->postJson('/api/items', ['name' => $itemName], $headers);

        $response
            ->assertStatus($expectedCode);
    }

    /**
     * @dataProvider dataProviderPUT
     */
    public function testItemUpdateRequest($itemId, $itemName, $expectedCode, $role)
    {
        $user = User::factory()->make(
            ['password' => bcrypt($password = 'i-love-laravel'),
            'role' => $role]);
        Passport::actingAs($user);

        $token = $user->createToken('Personal Access Token');
        $accessToken = $token->accessToken;
        $headers = ['Authorization' => 'Bearer'.$accessToken];

        $response = $this->putJson('/api/items/'.$itemId, ['name' => $itemName], $headers);

        $response
            ->assertStatus($expectedCode);
    }

    public function testItemDeleteRequest()
    {
        $user = User::factory()->make(
            ['password' => bcrypt($password = 'i-love-laravel'),
            'role' => 'admin']);
        Passport::actingAs($user);

        $token = $user->createToken('Personal Access Token');
        $accessToken = $token->accessToken;
        $headers = ['Authorization' => 'Bearer'.$accessToken];

        $itemId = 9;

        $response = $this->deleteJson('/api/items/'.$itemId, $headers);

        $response->assertStatus(204);
    }

    public function dataProviderPOST(){
        $data = [
            ['Hotdog', 201],
            [null, 404]
        ];
        return $data;
    }

    public function dataProviderGET(){
        $data = [
            [1, 200],
            [99999, 404]
        ];
        return $data;
    }

    public function dataProviderPUT(){
        $data = [
            [1, 'Lemon', 200, 'admin'],
            [2, 'Orange', 401, 'employee']
        ];
        return $data;
    }
}
