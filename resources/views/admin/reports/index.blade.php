@extends('layouts.admin')

@section('header')
    Laporan Keuangan
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const yearSelect = document.getElementById('year');
            const monthSelect = document.getElementById('month');
            let incomeChart, expenseChart, roomChart;

            function formatRupiah(amount) {
                return new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR'
                }).format(amount);
            }

            function updateCharts() {
                fetch(`{{ route('admin.reports.data') }}?year=${yearSelect.value}&month=${monthSelect.value}`)
                    .then(response => response.json())
                    .then(data => {
                        // Update Income vs Expense Chart
                        const months = Array.from({length: 12}, (_, i) => {
                            return new Date(2000, i).toLocaleString('id-ID', { month: 'long' });
                        });
                        
                        const incomeData = months.map((_, index) => {
                            return data.income[index + 1]?.total || 0;
                        });
                        
                        const expenseData = months.map((_, index) => {
                            return data.expenses[index + 1]?.total || 0;
                        });

                        if (incomeChart) incomeChart.destroy();
                        incomeChart = new Chart(document.getElementById('incomeExpenseChart'), {
                            type: 'line',
                            data: {
                                labels: months,
                                datasets: [
                                    {
                                        label: 'Pemasukan',
                                        data: incomeData,
                                        borderColor: '#10B981',
                                        backgroundColor: '#10B98133',
                                        fill: true
                                    },
                                    {
                                        label: 'Pengeluaran',
                                        data: expenseData,
                                        borderColor: '#EF4444',
                                        backgroundColor: '#EF444433',
                                        fill: true
                                    }
                                ]
                            },
                            options: {
                                responsive: true,
                                plugins: {
                                    title: {
                                        display: true,
                                        text: 'Grafik Pemasukan vs Pengeluaran'
                                    }
                                },
                                scales: {
                                    y: {
                                        beginAtZero: true,
                                        ticks: {
                                            callback: function(value) {
                                                return formatRupiah(value);
                                            }
                                        }
                                    }
                                }
                            }
                        });

                        // Update Popular Rooms Chart
                        if (roomChart) roomChart.destroy();
                        roomChart = new Chart(document.getElementById('popularRoomsChart'), {
                            type: 'bar',
                            data: {
                                labels: data.popularRooms.map(room => room.name),
                                datasets: [{
                                    label: 'Jumlah Booking',
                                    data: data.popularRooms.map(room => room.booking_count),
                                    backgroundColor: '#10B981'
                                }]
                            },
                            options: {
                                responsive: true,
                                plugins: {
                                    title: {
                                        display: true,
                                        text: 'Kamar Terpopuler'
                                    }
                                },
                                scales: {
                                    y: {
                                        beginAtZero: true,
                                        ticks: {
                                            stepSize: 1
                                        }
                                    }
                                }
                            }
                        });

                        // Update Expense Categories Chart
                        if (expenseChart) expenseChart.destroy();
                        expenseChart = new Chart(document.getElementById('expenseCategoriesChart'), {
                            type: 'doughnut',
                            data: {
                                labels: data.expensesByCategory.map(cat => cat.name),
                                datasets: [{
                                    data: data.expensesByCategory.map(cat => cat.total),
                                    backgroundColor: [
                                        '#10B981', '#3B82F6', '#F59E0B', '#EF4444', '#8B5CF6',
                                        '#EC4899', '#14B8A6', '#6366F1', '#D946EF', '#F97316'
                                    ]
                                }]
                            },
                            options: {
                                responsive: true,
                                plugins: {
                                    title: {
                                        display: true,
                                        text: 'Pengeluaran per Kategori'
                                    },
                                    tooltip: {
                                        callbacks: {
                                            label: function(context) {
                                                return `${context.label}: ${formatRupiah(context.raw)}`;
                                            }
                                        }
                                    }
                                }
                            }
                        });
                    });
            }

            yearSelect.addEventListener('change', updateCharts);
            monthSelect.addEventListener('change', updateCharts);
            updateCharts();
        });
    </script>
@endpush

@section('content')
    <div class="space-y-6">
        <!-- Filter and Export Section -->
        <div class="bg-white p-6 rounded-lg shadow">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label for="month" class="block text-sm font-medium text-gray-700 mb-2">Bulan</label>
                    <select id="month" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                        <option value="">Semua Bulan</option>
                        @foreach(range(1, 12) as $month)
                            <option value="{{ $month }}">{{ date('F', mktime(0, 0, 0, $month, 1)) }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="year" class="block text-sm font-medium text-gray-700 mb-2">Tahun</label>
                    <select id="year" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                        @foreach($years as $year)
                            <option value="{{ $year }}" {{ $year == date('Y') ? 'selected' : '' }}>{{ $year }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex items-end">
                    <a href="#" onclick="event.preventDefault(); window.location.href = '{{ route('admin.reports.export') }}?year=' + document.getElementById('year').value + '&month=' + document.getElementById('month').value"
                        class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">
                        Export Excel
                    </a>
                </div>
            </div>
        </div>

        <!-- Charts Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Income vs Expense Chart -->
            <div class="bg-white p-6 rounded-lg shadow">
                <canvas id="incomeExpenseChart"></canvas>
            </div>

            <!-- Popular Rooms Chart -->
            <div class="bg-white p-6 rounded-lg shadow">
                <canvas id="popularRoomsChart"></canvas>
            </div>

            <!-- Expense Categories Chart -->
            <div class="bg-white p-6 rounded-lg shadow">
                <canvas id="expenseCategoriesChart"></canvas>
            </div>
        </div>
    </div>
@endsection 