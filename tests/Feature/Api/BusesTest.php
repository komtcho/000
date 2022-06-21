<?php

namespace Tests\Feature\Api;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BusesTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test access to buses in the case of logging in.
     *
     * @return void
     */
    public function test_listing_success_buses()
    {
        $user = User::factory()->create();
        $token = $user->createToken('auth_token')->plainTextToken;

        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'authorization' => 'Bearer ' . $token,
        ])->get('/api/buses');

        $response->assertStatus(200);
    }

    /**
     * Test to get buses in case you are not logged in.
     *
     * @return void
     */
    public function test_listing_not_authorized_buses()
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->get('/api/buses');

        $response->assertStatus(401);
    }
}
