<?php

namespace App\Http\Livewire;

use App\Models\Bus;
use App\Models\Station;
use App\Models\Ticket;
use App\Models\User;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Booking extends Component
{
    use LivewireAlert;

    public $stationsTarget = null;
    public $stationsCount = null;
    public $totalCountForTickets = null;
    public $seatsAvailable = null;

    public $bus_id;
    public $user_id;
    public $station_from_id;
    public $station_to_id;

    public function departureStation()
    {
        $this->stationsTarget = Station::where('id', '>', $this->station_from_id)->get();
    }

    public function arrivalStation()
    {
        $this->stationsCount = Station::where('id', '>', $this->station_from_id)
            ->where('id', '<=', $this->station_to_id)
            ->count();

            $this->seatsAvailable = Ticket::where('bus_id', '=', $this->bus_id)
            ->where('station_from_id', '>=', $this->station_from_id)
            ->where('station_to_id', '<=', $this->station_to_id)
            ->count();
    }

    public function book()
    {
        if ($this->seatsAvailable >= 12) {
            return $this->alert('warning', 'No seats available.');
        }

        $ticket = Ticket::create([
            'user_id' => $this->user_id,
            'bus_id' => $this->bus_id,
            'station_from_id' => $this->station_from_id,
            'station_to_id' => $this->station_to_id,
        ]);

        $this->alert('success', 'Seat reserved ticket number is: ' . $ticket->id);
    }

    public function render()
    {
        $buses = Bus::get();
        $users = User::get();
        $stations = Station::get();

        return view('livewire.booking', [
            'buses' => $buses,
            'users' => $users,
            'stations' => $stations,
            'stations_target' => $this->stationsTarget,
            'stations_count' => $this->stationsCount,
            'seats_available_count' => $this->seatsAvailable,
        ]);
    }
}
