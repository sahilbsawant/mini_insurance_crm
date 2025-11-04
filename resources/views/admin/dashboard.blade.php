<x-app-layout>
    <div class="max-w-6xl mx-auto py-8 px-4">

        <!-- COUNTS -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            
            <div class="p-6 bg-white shadow rounded">
                <h3 class="text-lg font-semibold">Total Policies</h3>
                <p class="text-2xl mt-2 font-bold">{{ $totalPolicies }}</p>
            </div>

            <div class="p-6 bg-white shadow rounded">
                <h3 class="text-lg font-semibold">Open Tickets</h3>
                <p class="text-2xl mt-2 font-bold">{{ $openTickets }}</p>
            </div>

            <div class="p-6 bg-white shadow rounded">
                <h3 class="text-lg font-semibold">Closed Tickets</h3>
                <p class="text-2xl mt-2 font-bold">{{ $closedTickets }}</p>
            </div>
        </div>


        <!-- PERFORMANCE CHART -->
        <div class="p-6 bg-white shadow rounded mt-8">
            <h3 class="text-lg font-semibold mb-4">User Performance (Tickets Handled)</h3>

            <canvas id="performanceChart"></canvas>
        </div>

    </div>

    <!-- CHART JS -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // Data from controller
        const userNames = @json($userNames);
        const userTicketCounts = @json($userTicketCounts);

        const ctx2 = document.getElementById('performanceChart').getContext('2d');

        new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: userNames,
                datasets: [{
                    label: "Tickets Handled",
                    data: userTicketCounts,
                    backgroundColor: "rgba(16, 185, 129, 0.5)",
                    borderColor: "rgb(16, 185, 129)",
                    borderWidth: 1,
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
