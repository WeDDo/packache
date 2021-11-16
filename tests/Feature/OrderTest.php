<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;
use Tests\TestCase;

class OrderTest extends TestCase
{
    public function testOrderIndexRequest()
    {
        $user = User::factory()->make(
            ['password' => bcrypt($password = 'i-love-laravel'),
            'role' => 'admin']);
        Passport::actingAs($user);

        $token = $user->createToken('Personal Access Token');
        $accessToken = $token->accessToken;
        $headers = ['Authorization' => 'Bearer'.$accessToken];

        $response = $this->get('/api/orders', $headers);

        $response->assertStatus(200);
    }

    /**
     * @dataProvider dataProviderGET
     */
    public function testOrderReadRequest($orderId, $expectedCode)
    {
        $user = User::factory()->make(
            ['password' => bcrypt($password = 'i-love-laravel'),
            'role' => 'admin']);
        Passport::actingAs($user);

        $token = $user->createToken('Personal Access Token');
        $accessToken = $token->accessToken;
        $headers = ['Authorization' => 'Bearer'.$accessToken];

        $response = $this->get('/api/orders/'.$orderId, $headers);

        $response->assertStatus($expectedCode);
    }

    /**
     * @dataProvider dataProviderPOST
     */
    public function testOrderPostRequest($orderRecipient, $expectedCode)
    {
        $user = User::factory()->make(
            ['password' => bcrypt($password = 'i-love-laravel'),
            'role' => 'admin']);
        Passport::actingAs($user);

        $token = $user->createToken('Personal Access Token');
        $accessToken = $token->accessToken;
        $headers = ['Authorization' => 'Bearer'.$accessToken];

        $response = $this->postJson('/api/orders', ['recipient' => $orderRecipient]);

        $response
            ->assertStatus($expectedCode);
    }

    /**
     * @dataProvider dataProviderPUT
     */
    public function testOrderUpdateRequest($orderId, $orderRecipient, $expectedCode, $role)
    {
        $user = User::factory()->make(
            ['password' => bcrypt($password = 'i-love-laravel'),
            'role' => $role]);
        Passport::actingAs($user);

        $token = $user->createToken('Personal Access Token');
        $accessToken = $token->accessToken;
        $headers = ['Authorization' => 'Bearer'.$accessToken];

        $response = $this->putJson('/api/orders/'.$orderId, ['recipient' => $orderRecipient], $headers);

        $response
            ->assertStatus($expectedCode);
    }

    public function testOrderDeleteRequest()
    {
        $user = User::factory()->make(
            ['password' => bcrypt($password = 'i-love-laravel'),
            'role' => 'admin']);
        Passport::actingAs($user);

        $token = $user->createToken('Personal Access Token');
        $accessToken = $token->accessToken;
        $headers = ['Authorization' => 'Bearer'.$accessToken];

        $orderId = 2;

        $response = $this->deleteJson('/api/orders/'.$orderId, $headers);

        $response->assertStatus(204);
    }

    public function dataProviderPOST(){
        $data = [
            ['Senukai', 201],
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
            [1, 'Maxima', 200, 'admin'],
            [2, 'Silas', 401, 'employee']
        ];
        return $data;
    }
}
