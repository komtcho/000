<?php

namespace Tests\Feature\Api;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class BookingTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();

        // seed the database
        $this->artisan('db:seed');
    }

    /**
     * Test booking seats available.
     *
     * @return void
     */
    public function test_booking_seats_available()
    {
        $user = User::factory()->create();
        $token = $user->createToken('auth_token')->plainTextToken;

        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'authorization' => 'Bearer ' . $token,
        ])->get('api/book?bus_id=1&station_from_id=1&station_to_id=2');

        $response->assertStatus(200);
    }

    /**
     * Test booking seats available not validation.
     *
     * @return void
     */
    public function test_booking_seats_available_not_validation()
    {
        $user = User::factory()->create();
        $token = $user->createToken('auth_token')->plainTextToken;

        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'authorization' => 'Bearer ' . $token,
        ])->get('api/book?bus_id=1&station_to_id=2');

        $response->assertStatus(422);
    }

    /**
     * Test booking.
     *
     * @return void
     */
    public function test_booking()
    {
        $user = User::factory()->create();
        $token = $user->createToken('auth_token')->plainTextToken;

        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'authorization' => 'Bearer ' . $token,
        ])->post('/api/book', [
            'bus_id' => 1,
            'station_from_id' => 1,
            'station_to_id' => 6,
        ]);

        $response->assertStatus(200);
    }

    /**
     * Test booking not authorize.
     *
     * @return void
     */
    public function test_booking_not_authorize()
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->post('/api/book', [
            'bus_id' => 1,
            'station_from_id' => 1,
            'station_to_id' => 6,
        ]);

        $response->assertStatus(401);
    }

    /**
     * Test booking select station not available.
     *
     * @return void
     */
    public function test_booking_select_station_not_available()
    {
        $user = User::factory()->create();
        $token = $user->createToken('auth_token')->plainTextToken;

        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'authorization' => 'Bearer ' . $token,
        ])->post('/api/book', [
            'bus_id' => 1,
            'station_from_id' => 1,
            'station_to_id' => 7,
        ]);

        $response->assertStatus(422);
    }

    /**
     * Test booking number seats exceeded maximum.
     *
     * @return void
     */
    public function test_booking_number_seats_exceeded_maximum()
    {
        $user = User::factory()->create();
        $token = $user->createToken('auth_token')->plainTextToken;

        \App\Models\Ticket::factory(12)
            ->sequence(
                [
                    'user_id' => 1,
                    'bus_id' => 1,
                    'station_from_id' => 1,
                    'station_to_id' => 6,
                ],
            )
            ->create();

        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'authorization' => 'Bearer ' . $token,
        ])->post('/api/book', [
            'bus_id' => 1,
            'station_from_id' => 1,
            'station_to_id' => 6,
        ]);

        $response->assertStatus(400);
    }
}
