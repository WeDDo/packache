<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class AuthTest extends TestCase
{
    public function test_user_can_login_with_correct_credentials()
    {
        $user = User::factory()->create([
            'password' => bcrypt($password = 'i-love-laravel')
        ]);

        $response = $this->post('/api/login', [
            'email' => $user->email,
            'password' => $password,
        ]);

        $this->assertAuthenticatedAs($user);
        $response->assertStatus(200);
    }

    public function test_user_can_register()
    {
        $user = User::factory()->make([
            'password' => bcrypt($password = 'i-love-laravel'),
        ]);

        $response = $this->post('/api/register', [
            'username' => $user->username,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'email' => $user->email,
            'password' => $password,
        ]);
        $response->assertStatus(201);
    }
}
