<x-app-layout>
    <div class="max-w-4xl mx-auto py-8 px-4">

        <!-- Main Card -->
        <div class="bg-white shadow rounded-lg p-6 mt-4">

            <!-- Ticket Details -->
            <h2 class="text-xl font-semibold mb-4">{{ $ticket->subject }}</h2>

            <div class="space-y-3 text-gray-700">

                <p>
                    <strong>Description:</strong><br>
                    {{ $ticket->description }}
                </p>

                <p>
                    <strong>Status:</strong>
                    <span class="
                        px-2 py-1 text-xs rounded font-semibold
                        @if($ticket->status == 'open') bg-yellow-100 text-yellow-700
                        @elseif($ticket->status == 'in_progress') bg-blue-100 text-blue-700
                        @else bg-green-100 text-green-700
                        @endif
                    ">
                        {{ ucfirst($ticket->status) }}
                    </span>
                </p>

                <p>
                    <strong>Assigned To:</strong>
                    {{ $ticket->assignee?->name ?? 'Not Assigned' }}
                </p>

                <p>
                    <strong>Created By:</strong>
                    {{ $ticket->creator?->name ?? 'Unknown' }}
                </p>

                <p class="text-sm text-gray-500">
                    <strong>Created At:</strong> {{ $ticket->created_at->format('d M Y h:i A') }}
                </p>

            </div>

        </div>
    </div>
</x-app-layout>
