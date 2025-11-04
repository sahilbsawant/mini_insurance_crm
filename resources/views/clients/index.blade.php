<x-app-layout>
    <div class="max-w-5xl mx-auto py-8 px-4">

       
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-xl font-semibold text-gray-800">Clients</h2>
        </div>

        
        <div class="bg-white shadow rounded-lg p-6 mb-8">

            <h3 class="text-lg font-semibold mb-4">Add Client</h3>

            <form method="POST" action="{{ route('clients.store') }}" class="space-y-4">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm font-medium text-gray-700">Name</label>
                        <input type="text" name="name" required
                            class="w-full mt-1 border-gray-300 rounded-md px-3 py-2 focus:ring focus:ring-indigo-300"
                            placeholder="Enter client name">
                    </div>

                    <div>
                        <label class="text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="email"
                            class="w-full mt-1 border-gray-300 rounded-md px-3 py-2 focus:ring focus:ring-indigo-300"
                            placeholder="Enter email">
                    </div>

                    <div>
                        <label class="text-sm font-medium text-gray-700">Phone</label>
                        <input type="text" name="phone"
                            class="w-full mt-1 border-gray-300 rounded-md px-3 py-2 focus:ring focus:ring-indigo-300"
                            placeholder="Enter phone number">
                    </div>

                    <div>
                        <label class="text-sm font-medium text-gray-700">Address</label>
                        <textarea name="address"
                            class="w-full mt-1 border-gray-300 rounded-md px-3 py-2 focus:ring focus:ring-indigo-300"
                            placeholder="Enter address"></textarea>
                    </div>
                </div>

                
                <button type="submit"
                    class="px-4 py-2 bg-white text-black rounded-md hover:bg-gray-800 transition">
                    Save Client
                </button>
            </form>
        </div>

        
        @if(session('success'))
            <div class="mb-4 text-green-800 bg-green-200 border border-green-400 p-3 rounded-md">
                 {{ session('success') }}
            </div>
        @endif

        <!-- Table -->
        <div class="bg-white shadow rounded-lg overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-gray-100 border-b">
                    <tr>
                        <th class="py-3 px-4 text-left font-semibold text-gray-700">Name</th>
                        <th class="py-3 px-4 text-left font-semibold text-gray-700">Email</th>
                        <th class="py-3 px-4 text-left font-semibold text-gray-700">Phone</th>
                        <th class="py-3 px-4 text-left font-semibold text-gray-700">Created By</th>
                        <th class="py-3 px-4 text-left font-semibold text-gray-700">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($clients as $c)
                        <tr class="border-b">
                            <td class="py-2 px-4">{{ $c->name }}</td>
                            <td class="py-2 px-4">{{ $c->email }}</td>
                            <td class="py-2 px-4">{{ $c->phone }}</td>
                            <td class="py-2 px-4">{{ $c->creator?->name }}</td>

                            <td class="py-2 px-4 flex gap-2">

                                @can('update', $c)
                                <a href="{{ route('clients.show', $c) }}"
                                   class="px-3 py-1 rounded text-xs font-semibold
                                          bg-blue-600 text-white hover:bg-blue-700">
                                    Add Policy
                                </a>
                                @endcan

                                @can('delete', $c)
                                    <form action="{{ route('clients.destroy', $c) }}"
                                          method="POST"
                                          onsubmit="return confirm('Delete this client?')" >
                                        @csrf
                                        @method('DELETE')

                                        <button
                                           class="px-3 py-1 rounded text-xs font-semibold
                                                  bg-red-600 text-white hover:bg-red-700">
                                            Delete
                                        </button>

                                    </form>
                                @endcan

                                <a href="{{ route('tickets.create', $c) }}"
   class="px-3 py-1 rounded text-xs font-semibold
                                          bg-blue-600 text-white hover:bg-blue-700">
    Add Ticket
</a>

                            </td>
                        </tr>

                    @empty

                        <tr>
                            <td colspan="5" class="text-center py-4 text-gray-500">
                                No clients found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $clients->links() }}
        </div>

    </div>
</x-app-layout>
