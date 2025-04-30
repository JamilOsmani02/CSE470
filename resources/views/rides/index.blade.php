<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Rides') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Add New Ride Button --}}
            <div class="mb-4">
                <a href="{{ route('rides.create') }}" class="bg-green-500 text-white px-4 py-2 rounded">
                    + Add New Ride
                </a>
            </div>

            {{-- Upcoming Rides --}}
            <div class="bg-white p-6 shadow rounded">
                <h3 class="text-lg font-bold mb-4">Upcoming Rides</h3>
                @forelse ($upcoming as $ride)
                    <div class="border p-4 mb-3">
                        <p><strong>To:</strong> {{ $ride->destination }}</p>
                        <p><strong>Time:</strong> {{ $ride->ride_time->format('d M Y, h:i A') }}</p>
                        <p><strong>Details:</strong> {{ $ride->details }}</p>

                        @if (!$ride->is_cancelled)
                            <form 
                                action="{{ route('rides.cancel', $ride) }}" 
                                method="POST" 
                                class="mt-2" 
                                onsubmit="return confirm('Are you sure you want to cancel this ride?');"
                            >
                                @csrf
                                <button class="bg-red-500 text-white px-4 py-1 rounded">Cancel Ride</button>
                            </form>
                        @else
                            <p class="text-red-500 mt-2">Cancelled</p>
                        @endif
                    </div>
                @empty
                    <p>No upcoming rides.</p>
                @endforelse
            </div>

            {{-- Past Rides --}}
            <div class="bg-white p-6 shadow rounded">
                <h3 class="text-lg font-bold mb-4">Past Rides</h3>
                @forelse ($past as $ride)
                    <div class="border p-4 mb-3">
                        <p><strong>To:</strong> {{ $ride->destination }}</p>
                        <p><strong>Time:</strong> {{ $ride->ride_time->format('d M Y, h:i A') }}</p>
                        <p><strong>Details:</strong> {{ $ride->details }}</p>

                        @if ($ride->is_cancelled)
                            <p class="text-red-500">Cancelled</p>
                        @endif

                        {{-- Rating & Review Form --}}
                        @if (!$ride->is_cancelled && $ride->reviews->where('user_id', auth()->id())->isEmpty())
                            <form action="{{ route('rides.review', $ride) }}" method="POST" class="mt-3">
                                @csrf
                                <label class="block mb-1 font-semibold">Rate this ride:</label>
                                <select name="rating" class="border rounded px-2 py-1 mb-2" required>
                                    <option value="">Select Rating</option>
                                    @for ($i = 1; $i <= 5; $i++)
                                        <option value="{{ $i }}">{{ $i }} Star{{ $i > 1 ? 's' : '' }}</option>
                                    @endfor
                                </select>

                                <textarea name="comment" rows="2" class="w-full border px-2 py-1 rounded mb-2" placeholder="Optional comment..."></textarea>

                                <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded">Submit Review</button>
                            </form>
                        @endif

                        {{-- Show Reviews --}}
                        @if ($ride->reviews->isNotEmpty())
                            <div class="mt-3">
                                <h4 class="font-bold mb-1">Reviews:</h4>
                                @foreach ($ride->reviews as $review)
                                    <div class="border-t pt-2 mt-2">
                                        <p><strong>{{ $review->user->name }}</strong> rated: {{ $review->rating }}/5</p>
                                        @if ($review->comment)
                                            <p>{{ $review->comment }}</p>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @empty
                    <p>No past rides.</p>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>
