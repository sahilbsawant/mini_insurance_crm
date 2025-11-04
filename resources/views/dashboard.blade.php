<x-app-layout>


    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between mb-8">
            <h1 class="text-2xl font-semibold text-black-800">Dashboard</h1>

            <a href="/clients"
               class="px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg shadow hover:bg-indigo-700 transition">
                + Add Client
            </a>
        </div>

       
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">

            <div class="p-6 bg-white shadow rounded-lg border">
                <h3 class="text-lg font-semibold text-gray-700">Total Policies</h3>
                <p class="text-3xl font-bold mt-3 text-indigo-700">{{ $totalPolicies }}</p>
            </div>

            <div class="p-6 bg-white shadow rounded-lg border">
                <h3 class="text-lg font-semibold text-gray-700">Open Tickets</h3>
                <p class="text-3xl font-bold mt-3 text-yellow-600">{{ $openTickets }}</p>
            </div>

            <div class="p-6 bg-white shadow rounded-lg border">
                <h3 class="text-lg font-semibold text-gray-700">Closed Tickets</h3>
                <p class="text-3xl font-bold mt-3 text-green-600">{{ $closedTickets }}</p>
            </div>

        </div>
<br>
       
        <div class="bg-white shadow rounded-lg border p-6 mb-10">
            <h2 class="text-xl font-semibold mb-6 text-gray-800">Reports</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

             
                <div class="p-5 border rounded-lg bg-gray-50 shadow-sm">
                    <h3 class="text-lg font-semibold text-gray-700 mb-4">Daily Tickets Report</h3>

                    <div class="flex gap-4">
                        <a href="{{ route('reports.daily.pdf') }}"
                           class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                            PDF
                        </a>

                        <a href="{{ route('reports.daily.excel') }}"
                           class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                            Excel
                        </a>
                    </div>
                </div>

              
                <div class="p-5 border rounded-lg bg-gray-50 shadow-sm">
                    <h3 class="text-lg font-semibold text-gray-700 mb-4">Active Policies Report</h3>

                    <div class="flex gap-4">
                        <a href="{{ route('reports.policies.pdf') }}"
                           class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                            PDF
                        </a>

                        <a href="{{ route('reports.policies.excel') }}"
                           class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                            Excel
                        </a>
                    </div>
                </div>

            </div>

        </div>
    <br>
        
        <div class="bg-white shadow rounded-lg border p-6">
            <h2 class="text-xl font-semibold mb-4 text-gray-800">
                Weekly Performance (Closed Tickets)
            </h2>

            <canvas id="performanceChart" height="100"></canvas>
        </div>

    </div>

    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById('performanceChart');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode($weekLabels ?? ['Mon','Tue','Wed','Thu','Fri','Sat','Sun']) !!},
                datasets: [{
                    label: 'Tickets Closed',
                    data: {!! json_encode($weekData ?? [0,0,0,0,0,0,0]) !!},
                    borderColor: '#4F46E5',
                    backgroundColor: 'rgba(79, 70, 229, .3)',
                    borderWidth: 3,
                    tension: 0.4,
                    pointRadius: 4,
                }]
            },
            options: {
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });
    </script>

</x-app-layout>
