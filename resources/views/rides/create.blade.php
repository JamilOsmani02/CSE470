<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create a Ride') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow rounded">
                <form method="POST" action="{{ route('rides.store') }}">
                    @csrf
                    <div class="mb-4">
                        <label for="destination" class="block text-sm font-medium text-gray-700">Destination</label>
                        <input type="text" name="destination" id="destination" class="mt-1 block w-full rounded-md shadow-sm" required>
                    </div>

                    <div class="mb-4">
                        <label for="ride_time" class="block text-sm font-medium text-gray-700">Ride Time</label>
                        <!-- Date and Time input field with formatted value -->
                        <input type="text" name="ride_time" id="ride_time" class="mt-1 block w-full rounded-md shadow-sm" required placeholder="dd/mm/yy hh:mm" value="{{ old('ride_time') }}">
                    </div>

                    <div class="mb-4">
                        <label for="details" class="block text-sm font-medium text-gray-700">Ride Details</label>
                        <textarea name="details" id="details" rows="3" class="mt-1 block w-full rounded-md shadow-sm"></textarea>
                    </div>

                    <div class="mb-4">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Create Ride</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Include flatpickr JS and CSS -->
    <link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script>
        flatpickr("#ride_time", {
            enableTime: true,          
            dateFormat: "d/m/Y H:i",    
            altInput: true,             
            altFormat: "d/m/Y H:i K",  
            minuteIncrement: 1,         
    </script>
</x-app-layout>
