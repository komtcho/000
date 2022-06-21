<?php

namespace Tests\Feature\Api;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StationsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test access to stations in the case of logging in.
     *
     * @return void
     */
    public function test_listing_success_stations()
    {
        $user = User::factory()->create();
        $token = $user->createToken('auth_token')->plainTextToken;

        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'authorization' => 'Bearer ' . $token,
        ])->get('/api/stations');

        $response->assertStatus(200);
    }

    /**
     * Test to get stations in case you are not logged in.
     *
     * @return void
     */
    public function test_listing_not_authorized_stations()
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->get('/api/stations');

        $response->assertStatus(401);
    }
}
