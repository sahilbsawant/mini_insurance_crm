<x-app-layout>
    <div class="max-w-3xl mx-auto py-8 px-4">

        <!-- ✅ SUCCESS MESSAGE -->
        @if(session('success'))
            <div class="mb-4 text-green-800 bg-white-200 border border-green-400 p-3 rounded-md">
                {{ session('success') }}
            </div>
        @endif

        <!-- ✅ CREATE TICKET FORM -->
        <div class="bg-white shadow rounded-lg p-6 mt-4">
            <h2 class="text-xl font-semibold mb-4">Create Ticket</h2>

            <form action="{{ route('tickets.store', $client) }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label class="text-sm font-medium">Subject</label>
                    <input type="text" name="subject" required
                           class="mt-1 w-full border rounded px-3 py-2 focus:ring focus:ring-indigo-200">
                </div>

                <div>
                    <label class="text-sm font-medium">Description</label>
                    <textarea name="description" required
                              class="mt-1 w-full border rounded px-3 py-2 focus:ring focus:ring-indigo-200"></textarea>
                </div>

                <div>
                    <label class="text-sm font-medium">Status</label>
                    <select name="status"
                            class="mt-1 w-full border rounded px-3 py-2 focus:ring focus:ring-indigo-200">
                        <option value="open">Open</option>
                        <option value="in_progress">In Progress</option>
                        <option value="closed">Closed</option>
                    </select>
                </div>

                <button class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Save Ticket
                </button>
            </form>
        </div>


       
        <div class="bg-white shadow rounded-lg p-6 mt-6">
            <h3 class="text-lg font-semibold mb-3">Existing Tickets</h3>

            @if($tickets->count())
                <table class="w-full border rounded">
                    <thead>
                        <tr class="bg-gray-100 text-gray-700">
                            <th class="p-2 text-left">Subject</th>
                            <th class="p-2 text-left">Status</th>
                            <th class="p-2 text-left">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($tickets as $t)
                            <tr class="border-t">
                                <td class="p-2">{{ $t->subject }}</td>

                                <td class="p-2">
                                    <span class="
                                        px-2 py-1 rounded text-xs font-semibold
                                        @if($t->status == 'open') bg-yellow-100 text-yellow-700
                                        @elseif($t->status == 'in_progress') bg-blue-100 text-blue-700
                                        @else bg-green-100 text-green-700
                                        @endif
                                    ">
                                        {{ ucfirst($t->status) }}
                                    </span>
                                </td>

                                <td class="p-2">
                                    <a href="{{ route('tickets.show', $t) }}"
                                       class="text-indigo-600 hover:underline text-sm">
                                        View
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            @else
                <p class="text-gray-500">No tickets found.</p>
            @endif
        </div>

    </div>
</x-app-layout>
