<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
        ]);

        \App\Models\Station::factory(6)
            ->sequence(
                [
                    'next_station_id' => 2,
                    'name' => 'Asyut'
                ],
                [
                    'next_station_id' => 3,
                    'name' => 'AlMinya'
                ],
                [
                    'next_station_id' => 4,
                    'name' => 'AlFayyum'
                ],
                [
                    'next_station_id' => 5,
                    'name' => 'Giza'
                ],
                [
                    'next_station_id' => 6,
                    'name' => 'Cairo'
                ],
                [
                    'next_station_id' => null,
                    'name' => 'Alexandria'
                ]
            )
            ->create();

        \App\Models\Bus::factory(1)->create();

        \App\Models\Ticket::factory(6)
            ->sequence(
                [
                    'user_id' => 1,
                    'bus_id' => 1,
                    'station_from_id' => 1,
                    'station_to_id' => 6,
                ],
                [
                    'user_id' => 2,
                    'bus_id' => 1,
                    'station_from_id' => 1,
                    'station_to_id' => 5,
                ],
                [
                    'user_id' => 3,
                    'bus_id' => 1,
                    'station_from_id' => 1,
                    'station_to_id' => 6,
                ],
                [
                    'user_id' => 4,
                    'bus_id' => 1,
                    'station_from_id' => 2,
                    'station_to_id' => 5,
                ],
                [
                    'user_id' => 5,
                    'bus_id' => 1,
                    'station_from_id' => 2,
                    'station_to_id' => 6,
                ],
                [
                    'user_id' => 6,
                    'bus_id' => 1,
                    'station_from_id' => 2,
                    'station_to_id' => 4,
                ],
            )
            ->create();
    }
}
