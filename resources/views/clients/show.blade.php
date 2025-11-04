<x-app-layout>
    <div class="max-w-4xl mx-auto py-8 px-4">

        
        <a href="{{ route('clients.index') }}"
           class="text-indigo-600 hover:underline text-sm">
            ← Back to clients
        </a>

      
        <div class="bg-white shadow rounded-lg p-6 mt-4">

          
            <h2 class="text-xl font-semibold mb-4">{{ $client->name }}</h2>

            <div class="space-y-1 text-gray-700">
                <p><strong>Email:</strong> {{ $client->email ?? '-' }}</p>
                <p><strong>Phone:</strong> {{ $client->phone ?? '-' }}</p>
                <p><strong>Address:</strong> {{ $client->address ?? '-' }}</p>
            </div>

            <hr class="my-6">

           
            <h3 class="text-lg font-semibold mb-3">Add Policy</h3>

            <form action="{{ route('policies.store', $client) }}" method="POST" class="space-y-4">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <div>
                        <label class="text-sm font-medium">Policy Type</label>
                        <input type="text" name="policy_type" required
                               class="mt-1 w-full border rounded px-3 py-2 focus:ring focus:ring-indigo-200">
                    </div>

                    <div>
                        <label class="text-sm font-medium">Premium</label>
                        <input type="number" name="premium" step="0.01" required
                               class="mt-1 w-full border rounded px-3 py-2 focus:ring focus:ring-indigo-200">
                    </div>

                    <div>
                        <label class="text-sm font-medium">Renewal Date</label>
                        <input type="date" name="renewal_date"
                               class="mt-1 w-full border rounded px-3 py-2 focus:ring focus:ring-indigo-200">
                    </div>

                    <div>
                        <label class="text-sm font-medium">Status</label>
                        <select name="status"
                            class="mt-1 w-full border rounded px-3 py-2 focus:ring focus:ring-indigo-200">
                            <option value="active">Active</option>
                            <option value="expired">Expired</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                    </div>
                </div>
                <br>
                <button class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-indigo-700">
                    Add Policy
                </button>
            </form>

            <hr class="my-6">

            
            <h3 class="text-lg font-semibold mb-3">Policies</h3>

            @if($client->policies->count())
                <table class="w-full border rounded">
                    <thead>
                        <tr class="bg-gray-100 text-gray-700">
                            <th class="p-2 text-left">Type</th>
                            <th class="p-2 text-left">Premium</th>
                            <th class="p-2 text-left">Renewal</th>
                            <th class="p-2 text-left">Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($client->policies as $p)
                            <tr class="border-t">
                                <td class="p-2">{{ $p->policy_type }}</td>
                                <td class="p-2">₹{{ $p->premium }}</td>
                                <td class="p-2">{{ $p->renewal_date ?? '-' }}</td>
                                <td class="p-2">
                                    <span class="
                                        px-2 py-1 rounded text-xs font-semibold
                                        @if($p->status == 'active') bg-green-100 text-green-700
                                        @elseif($p->status == 'expired') bg-yellow-100 text-yellow-700
                                        @else bg-red-100 text-red-700
                                        @endif
                                    ">
                                        {{ ucfirst($p->status) }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            @else
                <p class="text-gray-500 mt-2">No policies found.</p>
            @endif

        </div>
    </div>
</x-app-layout>


