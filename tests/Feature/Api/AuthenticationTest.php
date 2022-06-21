<?php

namespace Tests\Feature\Api;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Login test if successful test.
     *
     * @return void
     */
    public function test_api_success_login()
    {
        $user = User::factory()->create();
        
        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->post('/api/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertStatus(200);
    }

    /**
     * Failed login test
     *
     * @return void
     */
    public function test_api_failed_login()
    {
        $user = User::factory()->create();
        
        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->post('/api/login', [
            'email' => $user->email,
            'password' => 'wordpass',
        ]);

        $response->assertStatus(401);
    }

    /**
     * Validation login test
     *
     * @return void
     */
    public function test_api_validation_login()
    {        
        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->post('/api/login', [
            'password' => 'wordpass',
        ]);

        $response->assertStatus(401);
    }

    /**
     * Register test if successful test.
     *
     * @return void
     */
    public function test_api_success_register()
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->post('/api/register', [
            'name' => 'test',
            'email' => 'test@mail.com',
            'password' => 'password',
        ]);

        $response->assertStatus(200);
    }

    /**
     * Failed register test
     *
     * @return void
     */
    public function test_api_failed_register()
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->post('/api/register', [
            'name' => 'test',
            'email' => 'test@mail.com',
        ]);

        $response->assertStatus(422);
    }

    /**
     * Register test if successful test.
     *
     * @return void
     */
    public function test_api_check_has_already_register()
    {
        $user = User::factory()->create();

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->post('/api/register', [
            'name' => 'test',
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertStatus(422);
    }
}
