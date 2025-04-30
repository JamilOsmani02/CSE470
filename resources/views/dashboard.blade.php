<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="bg-white p-6 shadow rounded">
                <h3 class="text-lg font-bold mb-4">Your Dashboard</h3>
                <p>Welcome to your dashboard! From here, you can manage your rides.</p>
                
                <a href="{{ route('rides.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded mt-4 inline-block">
                    View My Rides
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
