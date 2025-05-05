@extends('layouts.admin')

@section('header', 'Dashboard')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Status Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Room Stats -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="p-5 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-700">Statistik Kamar</h3>
                </div>
                <div class="p-5">
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
            </div>

            <!-- Booking Stats -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="p-5 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-700">Statistik Pemesanan</h3>
                </div>
                <div class="p-5">
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

            <!-- Finance Stats -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="p-5 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-700">Keuangan Bulan Ini</h3>
                </div>
                <div class="p-5">
                    <div class="mb-6">
                        <p class="text-sm text-gray-600 mb-1">Pendapatan</p>
                        <p class="text-2xl font-bold text-green-600">Rp {{ number_format($financialStats['income'], 0, ',', '.') }}</p>
                    </div>
                    
                    <div class="mb-6">
                        <p class="text-sm text-gray-600 mb-1">Pengeluaran</p>
                        <p class="text-2xl font-bold text-red-600">Rp {{ number_format($financialStats['expense'], 0, ',', '.') }}</p>
                    </div>
                    
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Profit</p>
                        <p class="text-2xl font-bold {{ $financialStats['profit'] >= 0 ? 'text-green-600' : 'text-red-600' }}">
                            Rp {{ number_format($financialStats['profit'], 0, ',', '.') }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Alert Card -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="p-5 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-700">Status</h3>
                </div>
                <div class="p-5">
                    <div class="mb-4">
                        <div class="flex items-center p-4 mb-4 {{ $pendingPayments > 0 ? 'bg-yellow-100 border-l-4 border-yellow-500' : 'bg-green-100 border-l-4 border-green-500' }} rounded-md">
                            <div class="flex-shrink-0">
                                @if($pendingPayments > 0)
                                    <svg class="w-5 h-5 text-yellow-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                @else
                                    <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                    </svg>
                                @endif
                            </div>
                            <div class="ml-3">
                                @if($pendingPayments > 0)
                                    <p class="text-sm text-yellow-700">
                                        Ada <span class="font-medium">{{ $pendingPayments }}</span> pembayaran yang menunggu konfirmasi
                                    </p>
                                @else
                                    <p class="text-sm text-green-700">
                                        Semua pembayaran telah dikonfirmasi
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('admin.payments.index') }}" class="block w-full text-center px-4 py-2 bg-green-600 text-white font-medium rounded-md hover:bg-green-700 transition duration-150 ease-in-out">
                        Lihat Pembayaran
                    </a>
                </div>
            </div>
        </div>

        <!-- Charts -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            <!-- Income & Expense Chart -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="p-5 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-700">Pendapatan & Pengeluaran 6 Bulan Terakhir</h3>
                </div>
                <div class="p-5">
                    <canvas id="incomeExpenseChart" class="w-full h-64"></canvas>
                </div>
            </div>

            <!-- Expense by Category Chart -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="p-5 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-700">Pengeluaran per Kategori</h3>
                </div>
                <div class="p-5">
                    <canvas id="expenseByCategoryChart" class="w-full h-64"></canvas>
                </div>
            </div>
        </div>

        <!-- Recent Activities -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Recent Bookings -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="p-5 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-700">Pemesanan Terbaru</h3>
                </div>
                <div class="p-0">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kamar</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($recentBookings as $booking)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">{{ $booking->name_booking }}</div>
                                        <div class="text-sm text-gray-500">{{ $booking->phone_booking }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $booking->room->room_name }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $booking->created_at->format('d M Y') }}</div>
                                        <div class="text-sm text-gray-500">{{ $booking->created_at->format('H:i') }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            {{ $booking->booking_status == 'Confirmed' ? 'bg-green-100 text-green-800' : 
                                              ($booking->booking_status == 'Pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                            {{ $booking->booking_status }}
                                        </span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">
                                        Tidak ada data pemesanan terbaru
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="p-3 border-t border-gray-200">
                        <a href="{{ route('admin.bookings.index') }}" class="text-sm font-medium text-green-600 hover:text-green-700">
                            Lihat semua pemesanan &rarr;
                        </a>
                    </div>
                </div>
            </div>

            <!-- Recent Expenses -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="p-5 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-700">Pengeluaran Terbaru</h3>
                </div>
                <div class="p-0">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Deskripsi</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($recentExpenses as $expense)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $expense->description }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                            {{ $expense->category->color ? 'bg-' . $expense->category->color . '-100 text-' . $expense->category->color . '-800' : 'bg-gray-100 text-gray-800' }}">
                                            {{ $expense->category->name }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $expense->expense_date->format('d M Y') }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        Rp {{ number_format($expense->amount, 0, ',', '.') }}
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">
                                        Tidak ada data pengeluaran terbaru
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="p-3 border-t border-gray-200">
                        <a href="{{ route('admin.expenses.index') }}" class="text-sm font-medium text-green-600 hover:text-green-700">
                            Lihat semua pengeluaran &rarr;
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Income & Expense Chart
        const incomeExpenseCtx = document.getElementById('incomeExpenseChart').getContext('2d');
        const incomeExpenseChart = new Chart(incomeExpenseCtx, {
            type: 'bar',
            data: {
                labels: @json($chartData['months']),
                datasets: [
                    {
                        label: 'Pendapatan',
                        data: @json($chartData['income']),
                        backgroundColor: 'rgba(34, 197, 94, 0.5)',
                        borderColor: 'rgb(34, 197, 94)',
                        borderWidth: 1
                    },
                    {
                        label: 'Pengeluaran',
                        data: @json($chartData['expense']),
                        backgroundColor: 'rgba(239, 68, 68, 0.5)',
                        borderColor: 'rgb(239, 68, 68)',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return 'Rp ' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                            }
                        }
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.dataset.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                if (context.parsed.y !== null) {
                                    label += 'Rp ' + context.parsed.y.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                                }
                                return label;
                            }
                        }
                    }
                }
            }
        });

        // Expense by Category Chart
        const expenseByCategory = @json($expenseByCategory);
        const expenseByCategoryCtx = document.getElementById('expenseByCategoryChart').getContext('2d');
        
        // Default colors if no color specified
        const defaultColors = [
            'rgba(54, 162, 235, 0.5)', // blue
            'rgba(255, 99, 132, 0.5)', // red
            'rgba(255, 206, 86, 0.5)', // yellow
            'rgba(75, 192, 192, 0.5)', // green
            'rgba(153, 102, 255, 0.5)', // purple
            'rgba(255, 159, 64, 0.5)' // orange
        ];
        
        // Map colors from categories or use defaults
        const backgroundColors = expenseByCategory.map((category, index) => {
            // Using Tailwind color classes if specified
            if (category.color) {
                switch(category.color) {
                    case 'red': return 'rgba(239, 68, 68, 0.5)';
                    case 'blue': return 'rgba(59, 130, 246, 0.5)';
                    case 'green': return 'rgba(34, 197, 94, 0.5)';
                    case 'yellow': return 'rgba(234, 179, 8, 0.5)';
                    case 'purple': return 'rgba(168, 85, 247, 0.5)';
                    case 'pink': return 'rgba(236, 72, 153, 0.5)';
                    case 'indigo': return 'rgba(99, 102, 241, 0.5)';
                    default: return defaultColors[index % defaultColors.length];
                }
            }
            return defaultColors[index % defaultColors.length];
        });
        
        const borderColors = backgroundColors.map(color => color.replace('0.5', '1'));
        
        // Extract data for chart
        const categoryNames = expenseByCategory.map(category => category.name);
        const categoryValues = expenseByCategory.map(category => category.total);
        
        const expenseByCategoryChart = new Chart(expenseByCategoryCtx, {
            type: 'doughnut',
            data: {
                labels: categoryNames,
                datasets: [{
                    data: categoryValues,
                    backgroundColor: backgroundColors,
                    borderColor: borderColors,
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'right',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                if (context.parsed !== null) {
                                    label += 'Rp ' + context.parsed.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                                }
                                return label;
                            }
                        }
                    }
                }
            }
        });
    });
</script>
@endpush
@endsection 