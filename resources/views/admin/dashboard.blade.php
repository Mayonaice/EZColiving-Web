@extends('layouts.admin')

@section('header', 'Dashboard')

@section('content')
<!-- Dashboard Header -->
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Dashboard</h1>
            
            <!-- Filter Bulan dan Tahun -->
            <div class="flex items-center space-x-4">
                <form action="{{ route('admin.home') }}" method="GET" class="flex items-center space-x-2">
                    <div>
                        <select name="month" id="month" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm rounded-md">
                            @foreach($months as $key => $monthName)
                                <option value="{{ $key }}" {{ $selectedMonth == $key ? 'selected' : '' }}>
                                    {{ $monthName }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <select name="year" id="year" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm rounded-md">
                            @foreach($years as $year)
                                <option value="{{ $year }}" {{ $selectedYear == $year ? 'selected' : '' }}>
                                    {{ $year }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        Filter Dashboard
                    </button>
                </form>
                <div class="text-sm text-gray-500">
                    <span>Periode: {{ $months[$selectedMonth] }} {{ $selectedYear }}</span>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Customers -->
            <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Total Pelanggan</p>
                        <p class="text-2xl font-bold">{{ number_format($totalCustomers) }}</p>
                    </div>
                    <div class="bg-gray-100 rounded-full p-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                        </svg>
                    </div>
                </div>
                <div class="mt-4">
                    <span class="inline-flex items-center text-xs {{ $customerGrowth >= 0 ? 'text-green-600' : 'text-red-600' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" 
                            viewBox="0 0 20 20" fill="currentColor"
                            style="{{ $customerGrowth >= 0 ? '' : 'transform: rotate(180deg)' }}">
                            <path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd" />
                        </svg>
                        {{ abs($customerGrowth) }}%
                    </span>
                </div>
            </div>

            <!-- Total Revenue -->
            <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Total Pendapatan</p>
                        <p class="text-2xl font-bold">Rp{{ number_format($totalRevenue, 0, ',', '.') }}</p>
                    </div>
                    <div class="bg-gray-100 rounded-full p-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z" />
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
                <div class="mt-4">
                    <span class="inline-flex items-center text-xs {{ $revenueGrowth >= 0 ? 'text-green-600' : 'text-red-600' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" 
                            viewBox="0 0 20 20" fill="currentColor"
                            style="{{ $revenueGrowth >= 0 ? '' : 'transform: rotate(180deg)' }}">
                            <path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd" />
                        </svg>
                        {{ abs($revenueGrowth) }}%
                    </span>
                </div>
            </div>

            <!-- Total Orders -->
            <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Pesanan Terkonfirmasi</p>
                        <p class="text-2xl font-bold">{{ number_format($totalOrders) }}</p>
                    </div>
                    <div class="bg-gray-100 rounded-full p-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M4 3a2 2 0 100 4h12a2 2 0 100-4H4z" />
                            <path fill-rule="evenodd" d="M3 8h14v7a2 2 0 01-2 2H5a2 2 0 01-2-2V8zm5 3a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
                <div class="mt-4">
                    <span class="inline-flex items-center text-xs {{ $orderDecline >= 0 ? 'text-green-600' : 'text-red-600' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" 
                            viewBox="0 0 20 20" fill="currentColor"
                            style="{{ $orderDecline >= 0 ? '' : 'transform: rotate(180deg)' }}">
                            <path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd" />
                        </svg>
                        {{ abs($orderDecline) }}%
                    </span>
                </div>
            </div>

            <!-- Total Expense Count -->
            <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Jumlah Pengeluaran</p>
                        <p class="text-2xl font-bold">{{ number_format($totalExpenseCount) }}</p>
                    </div>
                    <div class="bg-gray-100 rounded-full p-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
                <div class="mt-4">
                    <span class="inline-flex items-center text-xs {{ $expenseCountGrowth >= 0 ? 'text-green-600' : 'text-red-600' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" 
                            viewBox="0 0 20 20" fill="currentColor"
                            style="{{ $expenseCountGrowth >= 0 ? '' : 'transform: rotate(180deg)' }}">
                            <path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd" />
                        </svg>
                        {{ abs($expenseCountGrowth) }}%
                    </span>
                </div>
            </div>
        </div>

        <!-- Revenue Charts -->
        <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100 mb-8">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-lg font-semibold text-gray-900">Pendapatan Bulanan Tahun {{ $selectedYear }}</h2>
                <div class="flex space-x-4">
                    <div class="flex items-center">
                        <div class="h-3 w-3 rounded-full bg-blue-500 mr-2"></div>
                        <span class="text-sm text-gray-600">Pendapatan Kotor</span>
                    </div>
                    <div class="flex items-center">
                        <div class="h-3 w-3 rounded-full bg-green-500 mr-2"></div>
                        <span class="text-sm text-gray-600">Pendapatan Bersih</span>
                    </div>
                </div>
            </div>

            <!-- Bar Chart -->
            <div class="mt-4" style="height: 300px;">
                <canvas id="productSalesChart"></canvas>
            </div>
        </div>

        <!-- Category and Expenses -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Sales by Kamar -->
            <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100">
                <h2 class="text-lg font-semibold text-gray-900 mb-6">Penjualan berdasarkan Kamar ({{ $months[$selectedMonth] }} {{ $selectedYear }})</h2>
                <div class="flex justify-center">
                    <div class="w-64 h-64">
                        <canvas id="roomSalesChart"></canvas>
                    </div>
                </div>
                <div class="mt-6 grid grid-cols-2 gap-2">
                    @foreach($roomCategories as $room)
                    <div class="flex items-center">
                        <div class="h-3 w-3 rounded-full bg-{{ 'blue' }}-{{ 300 + ($loop->index * 100) % 400 }} mr-2"></div>
                        <span class="text-sm text-gray-600">{{ $room['name'] }} - {{ $room['percentage'] }}%</span>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Expenses by Category -->
            <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100">
                <h2 class="text-lg font-semibold text-gray-900 mb-6">Pengeluaran berdasarkan Kategori ({{ $months[$selectedMonth] }} {{ $selectedYear }})</h2>
                <div class="grid gap-6">
                    <div>
                        @forelse($expenses as $expense)
                        <div class="mb-3">
                            <div class="flex justify-between text-sm mb-1 expense-category cursor-pointer" data-category-id="{{ $expense['id'] }}">
                                <span class="text-gray-600">{{ $expense['name'] }} ({{ $expense['count'] }} item)</span>
                                <span class="font-medium">Rp {{ number_format($expense['amount'], 0, ',', '.') }} ({{ $expense['percentage'] }}%)</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-1.5">
                                <div class="bg-red-500 h-1.5 rounded-full" style="width: {{ $expense['percentage'] }}%"></div>
                            </div>
                            <!-- Detail pengeluaran tersembunyi -->
                            <div id="expense-details-{{ $expense['id'] }}" class="hidden bg-gray-50 rounded-md p-3 mt-2 mb-3">
                                <h3 class="text-sm font-semibold mb-2">Detail Pengeluaran {{ $expense['name'] }}</h3>
                                <div class="max-h-40 overflow-y-auto">
                                    <table class="min-w-full divide-y divide-gray-200 text-xs">
                                        <thead class="bg-gray-100">
                                            <tr>
                                                <th class="px-2 py-1 text-left text-gray-500">Tanggal</th>
                                                <th class="px-2 py-1 text-left text-gray-500">Deskripsi</th>
                                                <th class="px-2 py-1 text-right text-gray-500">Jumlah</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200" id="expense-items-{{ $expense['id'] }}">
                                            <!-- Data akan dimuat dengan JavaScript -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="text-center text-gray-500 py-4">
                            Tidak ada data pengeluaran untuk periode ini
                        </div>
                        @endforelse
                    </div>
                    @if(count($expenses) > 0)
                    <div class="mt-4">
                        <div class="p-4 bg-red-50 rounded-lg">
                            <div class="flex justify-between items-center">
                                <span class="text-sm font-medium text-gray-700">Total Pengeluaran</span>
                                <span class="text-lg font-bold text-red-600">Rp {{ number_format($totalExpenseAmount, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        
        <!-- Statistik Lainnya -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-8">
            <!-- Room Stats -->
            <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Statistik Kamar ({{ $months[$selectedMonth] }} {{ $selectedYear }})</h2>
                <div class="mb-4">
                    <div class="flex justify-between items-center mb-1">
                        <span class="text-sm text-gray-600">Total Kamar</span>
                        <span class="text-sm font-bold">{{ $roomStats['total'] }}</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-green-600 h-2 rounded-full" style="width: 100%"></div>
                    </div>
                </div>
                
                <div class="mb-4">
                    <div class="flex justify-between items-center mb-1">
                        <span class="text-sm text-gray-600">Tersedia</span>
                        <span class="text-sm font-bold">{{ $roomStats['available'] }}</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-blue-500 h-2 rounded-full" style="width: {{ $roomStats['total'] > 0 ? ($roomStats['available'] / $roomStats['total'] * 100) : 0 }}%"></div>
                    </div>
                </div>
                
                <div class="mb-4">
                    <div class="flex justify-between items-center mb-1">
                        <span class="text-sm text-gray-600">Terpesan</span>
                        <span class="text-sm font-bold">{{ $roomStats['booked'] }}</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-orange-500 h-2 rounded-full" style="width: {{ $roomStats['total'] > 0 ? ($roomStats['booked'] / $roomStats['total'] * 100) : 0 }}%"></div>
                    </div>
                </div>
                
                <div>
                    <div class="flex justify-between items-center mb-1">
                        <span class="text-sm text-gray-600">Dalam Perbaikan</span>
                        <span class="text-sm font-bold">{{ $roomStats['maintenance'] }}</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-red-500 h-2 rounded-full" style="width: {{ $roomStats['total'] > 0 ? ($roomStats['maintenance'] / $roomStats['total'] * 100) : 0 }}%"></div>
                    </div>
                </div>
            </div>

            <!-- Booking Stats -->
            <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Statistik Pemesanan ({{ $months[$selectedMonth] }} {{ $selectedYear }})</h2>
                <div class="mb-4">
                    <div class="flex justify-between items-center mb-1">
                        <span class="text-sm text-gray-600">Total Pemesanan</span>
                        <span class="text-sm font-bold">{{ $bookingStats['total'] }}</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-green-600 h-2 rounded-full" style="width: 100%"></div>
                    </div>
                </div>
                
                <div class="mb-4">
                    <div class="flex justify-between items-center mb-1">
                        <span class="text-sm text-gray-600">Dikonfirmasi</span>
                        <span class="text-sm font-bold">{{ $bookingStats['confirmed'] }}</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-blue-500 h-2 rounded-full" style="width: {{ $bookingStats['total'] > 0 ? ($bookingStats['confirmed'] / $bookingStats['total'] * 100) : 0 }}%"></div>
                    </div>
                </div>
                
                <div class="mb-4">
                    <div class="flex justify-between items-center mb-1">
                        <span class="text-sm text-gray-600">Menunggu</span>
                        <span class="text-sm font-bold">{{ $bookingStats['pending'] }}</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-yellow-500 h-2 rounded-full" style="width: {{ $bookingStats['total'] > 0 ? ($bookingStats['pending'] / $bookingStats['total'] * 100) : 0 }}%"></div>
                    </div>
                </div>
                
                <div>
                    <div class="flex justify-between items-center mb-1">
                        <span class="text-sm text-gray-600">Dibatalkan</span>
                        <span class="text-sm font-bold">{{ $bookingStats['cancelled'] }}</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-red-500 h-2 rounded-full" style="width: {{ $bookingStats['total'] > 0 ? ($bookingStats['cancelled'] / $bookingStats['total'] * 100) : 0 }}%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- AI Chat & Prediksi Bisnis --}}
<div class="bg-white rounded-lg shadow p-4 mb-6 mt-10">
    <h3 class="font-bold mb-2">AI Bisnis Kos (Chat & Prediksi)</h3>
    <div id="ai-chat-log" class="mb-2 text-sm max-h-40 overflow-y-auto"></div>
    <form id="ai-chat-form" class="flex space-x-2">
        <input type="text" id="ai-chat-input" class="flex-1 border rounded px-2 py-1" placeholder="Tanya AI...">
        <button type="submit" class="bg-green-600 text-white px-4 py-1 rounded">Kirim</button>
    </form>
</div>
<div class="bg-white rounded-lg shadow p-4 mb-6" id="ai-prediction-box">
    <h3 class="font-bold mb-2">Prediksi Bisnis Otomatis</h3>
    <div id="ai-prediction-result" class="text-sm text-gray-700">Memuat prediksi...</div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Product Sales Chart (Pendapatan Kotor dan Bersih)
        const productSalesChart = document.getElementById('productSalesChart').getContext('2d');
        new Chart(productSalesChart, {
            type: 'bar',
            data: {
                labels: [
                    @foreach($salesData as $data)
                        '{{ $data['month'] }}',
                    @endforeach
                ],
                datasets: [{
                    label: 'Pendapatan Kotor',
                    data: [
                        @foreach($salesData as $data)
                            {{ $data['grossRevenue'] }},
                        @endforeach
                    ],
                    backgroundColor: '#3b82f6',
                    barPercentage: 0.6,
                    categoryPercentage: 0.5
                }, {
                    label: 'Pendapatan Bersih',
                    data: [
                        @foreach($salesData as $data)
                            {{ $data['netRevenue'] }},
                        @endforeach
                    ],
                    backgroundColor: '#10b981',
                    barPercentage: 0.6,
                    categoryPercentage: 0.5
                }]
            },
            options: {
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            display: true,
                            color: '#f3f4f6'
                        },
                        ticks: {
                            callback: function(value) {
                                return 'Rp ' + (value / 1000) + 'rb';
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.dataset.label + ': Rp' + context.parsed.y.toLocaleString();
                            }
                        }
                    }
                }
            }
        });

        // Room Sales Chart
        const roomSalesChart = document.getElementById('roomSalesChart').getContext('2d');
        new Chart(roomSalesChart, {
            type: 'doughnut',
            data: {
                labels: [
                    @foreach($roomCategories as $room)
                        '{{ $room['name'] }}',
                    @endforeach
                ],
                datasets: [{
                    data: [
                        @foreach($roomCategories as $room)
                            {{ $room['percentage'] }},
                        @endforeach
                    ],
                    backgroundColor: [
                        '#818cf8', // Indigo
                        '#60a5fa', // Blue
                        '#c084fc', // Purple
                        '#f472b6', // Pink
                        '#34d399', // Green
                        '#fbbf24', // Yellow
                        '#f87171', // Red
                        '#2dd4bf', // Teal
                        '#a3e635', // Lime
                    ],
                    borderWidth: 0,
                    hoverOffset: 8
                }]
            },
            options: {
                cutout: '70%',
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const value = typeof {{ $totalRoomRevenue }} === 'number' ? 
                                    parseInt(context.raw * {{ $totalRoomRevenue }} / 100) : 0;
                                return context.label + ': Rp' + value.toLocaleString() + ' (' + context.raw + '%)';
                            }
                        }
                    }
                }
            }
        });

        // Toggle detail pengeluaran saat kategori diklik
        const expenseCategories = document.querySelectorAll('.expense-category');
        expenseCategories.forEach(category => {
            category.addEventListener('click', function() {
                const categoryId = this.dataset.categoryId;
                const detailElement = document.getElementById(`expense-details-${categoryId}`);
                
                if (!detailElement) {
                    console.error(`Element with ID expense-details-${categoryId} not found`);
                    return;
                }
                
                const detailsContainer = document.getElementById(`expense-items-${categoryId}`);
                
                if (!detailsContainer) {
                    console.error(`Element with ID expense-items-${categoryId} not found`);
                    return;
                }

                // Toggle tampilan detail
                if (detailElement.classList.contains('hidden')) {
                    // Sembunyikan detail lain yang mungkin terbuka
                    document.querySelectorAll('[id^="expense-details-"]').forEach(el => {
                        if (el !== detailElement) {
                            el.classList.add('hidden');
                        }
                    });

                    // Tampilkan detail yang dipilih
                    detailElement.classList.remove('hidden');
                    
                    // Muat data pengeluaran untuk kategori ini jika belum dimuat
                    if (detailsContainer.innerHTML.trim() === '') {
                        try {
                            // Data pengeluaran dari PHP
                            const expenses = @json($expenseDetails);
                            
                            if (!expenses || !expenses[categoryId]) {
                                detailsContainer.innerHTML = '<tr><td colspan="3" class="px-2 py-2 text-center text-gray-500">Tidak ada data detail</td></tr>';
                                return;
                            }
                            
                            const categoryExpenses = expenses[categoryId] || [];
                            
                            if (categoryExpenses.length > 0) {
                                let html = '';
                                categoryExpenses.forEach(expense => {
                                    const date = new Date(expense.expense_date).toLocaleDateString('id-ID', {
                                        day: '2-digit',
                                        month: '2-digit',
                                        year: 'numeric'
                                    });
                                    html += `
                                    <tr>
                                        <td class="px-2 py-1 whitespace-nowrap">${date}</td>
                                        <td class="px-2 py-1">${expense.description}</td>
                                        <td class="px-2 py-1 text-right">Rp ${parseInt(expense.amount).toLocaleString()}</td>
                                    </tr>
                                    `;
                                });
                                detailsContainer.innerHTML = html;
                            } else {
                                detailsContainer.innerHTML = '<tr><td colspan="3" class="px-2 py-2 text-center text-gray-500">Tidak ada data detail</td></tr>';
                            }
                        } catch (error) {
                            console.error('Error loading expense details:', error);
                            detailsContainer.innerHTML = '<tr><td colspan="3" class="px-2 py-2 text-center text-red-500">Terjadi kesalahan saat memuat data</td></tr>';
                        }
                    }
                } else {
                    // Sembunyikan detail jika sudah terbuka
                    detailElement.classList.add('hidden');
                }
            });
        });
    });

    document.getElementById('ai-chat-form').onsubmit = async function(e) {
        e.preventDefault();
        const input = document.getElementById('ai-chat-input');
        const log = document.getElementById('ai-chat-log');
        const userMsg = input.value;
        log.innerHTML += `<div class='mb-1'><b>Anda:</b> ${userMsg}</div>`;
        input.value = '';
        const res = await fetch('{{ route('admin.ai.chat') }}', {
            method: 'POST',
            headers: {'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}'},
            body: JSON.stringify({prompt: userMsg})
        });
        const aiMsg = await res.text();
        log.innerHTML += `<div class='mb-2'><b>AI:</b> ${aiMsg}</div>`;
        log.scrollTop = log.scrollHeight;
    };
    // Data bisnis otomatis dari variabel dashboard
    const businessData = {
        total_kamar: {{ $totalRooms ?? 0 }},
        kamar_terisi: {{ $totalOrders ?? 0 }},
        pendapatan_bulan_ini: {{ $totalRevenue ?? 0 }},
        rata_rata_harga: {{ isset($totalRooms) && $totalRooms > 0 ? round($totalRevenue/$totalRooms) : 0 }},
        total_pelanggan: {{ $totalCustomers ?? 0 }},
        pengeluaran_bulan_ini: {{ $totalExpense ?? 0 }},
        pertumbuhan_pelanggan: {{ $customerGrowth ?? 0 }},
        pertumbuhan_pendapatan: {{ $revenueGrowth ?? 0 }},
    };
    fetch('{{ route('admin.ai.predict') }}', {
        method: 'POST',
        headers: {'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}'},
        body: JSON.stringify({data: businessData})
    })
    .then(res => res.text())
    .then(txt => {
        document.getElementById('ai-prediction-result').innerText = txt;
    });
</script>
@endpush 