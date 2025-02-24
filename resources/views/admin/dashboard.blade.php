<x-admin.layout>
    <x-slot name="header">
        {{ __('Dashboard') }}
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Payment Summary Row -->
            <div class="grid grid-cols-3 gap-6 mb-6">
                <div class="shadow-sm rounded-lg p-6 bg-white text-center">
                    <h2 class="text-lg font-semibold text-gray-800">Pending Payments</h2>
                    <p class="text-2xl font-bold text-yellow-600">{{ $pendingPayments }}</p>
                </div>
                <div class="shadow-sm rounded-lg p-6 bg-white text-center">
                    <h2 class="text-lg font-semibold text-gray-800">Completed Payments</h2>
                    <p class="text-2xl font-bold text-green-600">{{ $completePayments }}</p>
                </div>
                <div class="shadow-sm rounded-lg p-6 bg-white text-center">
                    <h2 class="text-lg font-semibold text-gray-800">Failed Payments</h2>
                    <p class="text-2xl font-bold text-red-600">{{ $failedPayments }}</p>
                </div>
            </div>

            <!-- Chart Section -->
            <div class="bg-white shadow-sm rounded-lg p-6">
                <h2 class="text-lg font-semibold text-gray-800">Monthly Payments Chart</h2>
                <canvas id="paymentChart"></canvas>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        var ctx = document.getElementById('paymentChart').getContext('2d');

        var chartData = @json(array_values($chartData)); // Numeric values
        var chartLabels = @json(array_keys($chartData)); // Month names

        // Create Gradient Background for Chart
        var gradient = ctx.createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, 'rgba(54, 162, 235, 0.6)');
        gradient.addColorStop(1, 'rgba(54, 162, 235, 0)');

        // Create Line Chart
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: chartLabels,
                datasets: [{
                    label: 'Total Payments',
                    data: chartData,
                    backgroundColor: gradient,
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false
                        }
                    },
                    y: {
                        beginAtZero: false,
                        min: 4000,
                        max: 20000,
                        ticks: {
                            stepSize: 2000 
                        }
                    }
                }
            }
        });
    });
</script>

</x-admin.layout>
