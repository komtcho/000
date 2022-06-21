<div>
    <form wire:submit.prevent="book">

        <div class="mt-4">
            <label class="block font-medium text-sm text-gray-700">Bus:</label>

            <select wire:model="user_id"
                class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                <option value=>Select bus</option>

                @foreach ($buses as $bus)
                    <option value="{{ $bus->id }}">{{ $bus->vehicle_id }}</option>
                @endforeach
            </select>
        </div>

        <div class="mt-4">
            <label class="block font-medium text-sm text-gray-700">User:</label>

            <select wire:model="bus_id"
                class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                <option value=>Select user</option>

                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mt-4">
            <label class="block font-medium text-sm text-gray-700">Station from:</label>

            <select wire:model="station_from_id" wire:change="departureStation"
                class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                <option value=>Select station</option>

                @foreach ($stations as $station)
                    <option value="{{ $station->id }}">{{ $station->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mt-4">
            <label class="block font-medium text-sm text-gray-700">Station to:</label>

            <select wire:model="station_to_id" wire:change="arrivalStation"
                class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                <option value=>Select station</option>

                @if ($stations_target)
                    @foreach ($stations_target as $station)
                        <option value="{{ $station->id }}">{{ $station->name }}</option>
                    @endforeach
                @endif
            </select>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if ($stations_count)
                <span class="text-sm text-gray-600 hover:text-gray-900">
                    <p>The number of stations between the selected stations: {{ $stations_count }}</p>
                    <p>Number of seats available: {{ 12 - $seats_available_count }}</p>
                </span>
            @endif
            <x-button class="ml-3">Book</x-button>
        </div>

    </form>
</div>
