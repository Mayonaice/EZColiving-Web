<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Expense;
use App\Models\ExpenseCategory;
use App\Models\GuestUser;
use App\Models\Payment;
use App\Models\Room;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Filter berdasarkan bulan untuk semua data
        $selectedMonth = $request->input('month', now()->month);
        $selectedYear = $request->input('year', now()->year);
        
        // Data untuk statistik kamar
        $roomStats = [
            'total' => Room::count(),
            'available' => Room::where('room_status', 'Available')->count(),
            'booked' => Room::where('room_status', 'Booked')->count(),
            'maintenance' => Room::where('room_status', 'Maintenance')->count(),
        ];

        // Data untuk statistik booking berdasarkan filter
        $bookingQuery = Booking::query();
        if ($request->filled('month') || $request->filled('year')) {
            $bookingQuery->whereYear('created_at', $selectedYear)
                       ->whereMonth('created_at', $selectedMonth);
        }
        
        $totalBookings = $bookingQuery->count();
        
        $bookingStats = [
            'total' => $totalBookings,
            'pending' => Booking::where('booking_status', 'Pending')
                          ->whereYear('created_at', $selectedYear)
                          ->whereMonth('created_at', $selectedMonth)
                          ->count(),
            'confirmed' => Booking::where('booking_status', 'Confirmed')
                            ->whereYear('created_at', $selectedYear)
                            ->whereMonth('created_at', $selectedMonth)
                            ->count(),
            'cancelled' => Booking::where('booking_status', 'Cancelled')
                            ->whereYear('created_at', $selectedYear)
                            ->whereMonth('created_at', $selectedMonth)
                            ->count(),
        ];

        // Data untuk statistik keuangan bulan yang dipilih
        $income = Booking::where('booking_status', 'Confirmed')
            ->whereYear('created_at', $selectedYear)
            ->whereMonth('created_at', $selectedMonth)
            ->sum('total_price');

        $expense = Expense::whereYear('expense_date', $selectedYear)
            ->whereMonth('expense_date', $selectedMonth)
            ->sum('amount');

        $financialStats = [
            'income' => $income,
            'expense' => $expense,
            'profit' => $income - $expense
        ];

        // Data transaksi terbaru dengan filter
        $recentBookings = Booking::with(['room', 'payment'])
            ->whereYear('created_at', $selectedYear)
            ->whereMonth('created_at', $selectedMonth)
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Data pengeluaran terbaru dengan filter
        $recentExpenses = Expense::with('category')
            ->whereYear('expense_date', $selectedYear)
            ->whereMonth('expense_date', $selectedMonth)
            ->orderBy('expense_date', 'desc')
            ->limit(5)
            ->get();

        // Data pembayaran yang menunggu konfirmasi dengan filter
        $pendingPayments = Payment::with(['booking', 'masterPayment'])
            ->where('payment_status', 'Pending')
            ->whereHas('booking')
            ->whereYear('created_at', $selectedYear)
            ->whereMonth('created_at', $selectedMonth)
            ->count();

        // Data untuk grafik pengeluaran berdasarkan kategori
        $expenseByCategory = ExpenseCategory::select('expense_categories.name', 'expense_categories.color', DB::raw('SUM(expenses.amount) as total'))
            ->leftJoin('expenses', 'expense_categories.id', '=', 'expenses.expense_category_id')
            ->whereYear('expenses.expense_date', $selectedYear)
            ->whereMonth('expenses.expense_date', $selectedMonth)
            ->groupBy('expense_categories.id', 'expense_categories.name', 'expense_categories.color')
            ->get();

        // Data untuk grafik pendapatan 6 bulan terakhir
        $sixMonthsAgo = now()->subMonths(5)->startOfMonth();
        
        $monthlyIncome = Booking::select(
                DB::raw('YEAR(created_at) as year'),
                DB::raw('MONTH(created_at) as month'),
                DB::raw('SUM(total_price) as total')
            )
            ->where('booking_status', 'Confirmed')
            ->where('created_at', '>=', $sixMonthsAgo)
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        $monthlyExpenses = Expense::select(
                DB::raw('YEAR(expense_date) as year'),
                DB::raw('MONTH(expense_date) as month'),
                DB::raw('SUM(amount) as total')
            )
            ->where('expense_date', '>=', $sixMonthsAgo)
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        // Format data untuk chart
        $months = [];
        $incomeData = [];
        $expenseData = [];

        for ($i = 0; $i < 6; $i++) {
            $date = now()->subMonths(5 - $i);
            $yearMonth = $date->format('Y-m');
            $months[] = $date->format('M Y');
            
            $monthIncome = $monthlyIncome->first(function($item) use ($date) {
                return $item->year == $date->year && $item->month == $date->month;
            });
            
            $monthExpense = $monthlyExpenses->first(function($item) use ($date) {
                return $item->year == $date->year && $item->month == $date->month;
            });
            
            $incomeData[] = $monthIncome ? $monthIncome->total : 0;
            $expenseData[] = $monthExpense ? $monthExpense->total : 0;
        }

        $chartData = [
            'months' => $months,
            'income' => $incomeData,
            'expense' => $expenseData,
        ];

        // Data untuk tampilan dashboard baru
        
        // 2. Total customers dari GuestUser yang sudah pernah memesan kamar
        // Fallback ke User jika relation bookings tidak ada di GuestUser
        try {
            // Filter berdasarkan bulan dan tahun jika filled
            $guestUserQuery = GuestUser::query();
            if ($request->filled('month') || $request->filled('year')) {
                $guestUserQuery->whereHas('bookings', function($query) use ($selectedYear, $selectedMonth) {
                    $query->whereYear('created_at', $selectedYear)
                          ->whereMonth('created_at', $selectedMonth);
                });
            } else {
                $guestUserQuery->whereHas('bookings');
            }
            $totalCustomers = $guestUserQuery->count();
        } catch (\Exception $e) {
            // Fallback ke user dengan role user
            $totalCustomers = User::where('role', 'user')->count();
        }
        
        // Data berdasarkan filter bulan dan tahun
        $totalRevenue = Payment::where('payment_status', 'Confirmed')
            ->whereYear('created_at', $selectedYear)
            ->whereMonth('created_at', $selectedMonth)
            ->sum('payment_amount');
        
        // 3. Total order jumlah pesanan kamar yang status nya sudah di confirm (filter)
        $totalOrders = Booking::where('booking_status', 'Confirmed')
            ->whereYear('created_at', $selectedYear)
            ->whereMonth('created_at', $selectedMonth)
            ->count();
        
        // Jumlah pengeluaran (filter)
        $totalExpenseCount = Expense::whereYear('expense_date', $selectedYear)
            ->whereMonth('expense_date', $selectedMonth)
            ->count();
        
        // Growth percentages - Hitung perbandingan dengan bulan sebelumnya
        $previousMonth = $selectedMonth == 1 ? 12 : $selectedMonth - 1;
        $previousYear = $selectedMonth == 1 ? $selectedYear - 1 : $selectedYear;
        
        // Hitung pertumbuhan customer
        try {
            $previousCustomers = GuestUser::whereHas('bookings', function($query) use ($previousYear, $previousMonth) {
                    $query->whereYear('created_at', $previousYear)
                          ->whereMonth('created_at', $previousMonth);
                })->count();
            $customerGrowth = $previousCustomers > 0 ? 
                (($totalCustomers - $previousCustomers) / $previousCustomers) * 100 : 0;
        } catch (\Exception $e) {
            $customerGrowth = 2.5; // Fallback placeholder
        }
        
        // Hitung pertumbuhan revenue
        $previousRevenue = Payment::where('payment_status', 'Confirmed')
            ->whereYear('created_at', $previousYear)
            ->whereMonth('created_at', $previousMonth)
            ->sum('payment_amount');
        $revenueGrowth = $previousRevenue > 0 ? 
            (($totalRevenue - $previousRevenue) / $previousRevenue) * 100 : 0;
        
        // Hitung pertumbuhan orders
        $previousOrders = Booking::where('booking_status', 'Confirmed')
            ->whereYear('created_at', $previousYear)
            ->whereMonth('created_at', $previousMonth)
            ->count();
        $orderDecline = $previousOrders > 0 ? 
            (($totalOrders - $previousOrders) / $previousOrders) * 100 : 0;
        
        // Hitung pertumbuhan expense
        $previousExpenseCount = Expense::whereYear('expense_date', $previousYear)
            ->whereMonth('expense_date', $previousMonth)
            ->count();
        $expenseCountGrowth = $previousExpenseCount > 0 ? 
            (($totalExpenseCount - $previousExpenseCount) / $previousExpenseCount) * 100 : 0;
        
        // Produk sales data - menggunakan data booking berdasarkan bulan dengan filter
        $salesData = [];
        
        for ($month = 1; $month <= 12; $month++) {
            // Pendapatan kotor per bulan dari booking yang sudah dikonfirmasi
            $grossRevenue = Booking::where('booking_status', 'Confirmed')
                ->whereYear('created_at', $selectedYear)
                ->whereMonth('created_at', $month)
                ->sum('total_price');
                
            // Pengeluaran per bulan
            $monthlyExpense = Expense::whereYear('expense_date', $selectedYear)
                ->whereMonth('expense_date', $month)
                ->sum('amount');
                
            // Pendapatan bersih (kotor - pengeluaran)
            $netRevenue = $grossRevenue - $monthlyExpense;
            
            $salesData[$month] = [
                'month' => Carbon::create($selectedYear, $month, 1)->format('M'),
                'grossRevenue' => $grossRevenue,
                'netRevenue' => $netRevenue
            ];
        }
        
        // 4. Sales by nama kamar (with filter)
        $roomSales = Room::select('rooms.id', 'rooms.room_name', DB::raw('COUNT(bookings.id) as booking_count'), DB::raw('SUM(bookings.total_price) as total_revenue'))
            ->leftJoin('bookings', 'rooms.id', '=', 'bookings.room_id')
            ->where('bookings.booking_status', 'Confirmed')
            ->whereYear('bookings.created_at', $selectedYear)
            ->whereMonth('bookings.created_at', $selectedMonth)
            ->groupBy('rooms.id', 'rooms.room_name')
            ->get();
            
        $roomCategories = [];
        $totalRoomRevenue = $roomSales->sum('total_revenue') ?: 1; // Avoid div by zero
        
        foreach ($roomSales as $room) {
            $percentage = ($room->total_revenue / $totalRoomRevenue) * 100;
            $roomCategories[] = [
                'name' => $room->room_name,
                'percentage' => round($percentage, 0),
                'amount' => $room->total_revenue
            ];
        }
        
        // 5. Expenses by category - Data difilter berdasarkan bulan dan tahun
        $expenseCategories = ExpenseCategory::withSum(['expenses' => function($query) use ($selectedYear, $selectedMonth) {
                                    $query->whereYear('expense_date', $selectedYear)
                                        ->whereMonth('expense_date', $selectedMonth);
                                }], 'amount')
                                ->withCount(['expenses' => function($query) use ($selectedYear, $selectedMonth) {
                                    $query->whereYear('expense_date', $selectedYear)
                                        ->whereMonth('expense_date', $selectedMonth);
                                }])
                                ->get();
                                
        $expenses = [];
        $totalExpenseAmount = $expenseCategories->sum('expenses_sum_amount') ?: 1; // Avoid div by zero
        
        foreach ($expenseCategories as $category) {
            $percentage = ($category->expenses_sum_amount / $totalExpenseAmount) * 100;
            $expenses[] = [
                'id' => $category->id,
                'name' => $category->name,
                'percentage' => round($percentage, 0),
                'amount' => $category->expenses_sum_amount,
                'count' => $category->expenses_count
            ];
        }
        
        // Detail pengeluaran per kategori untuk javascript dropdown
        $expenseDetails = [];
        
        // Ambil semua kategori expense, tidak hanya yang ada datanya di bulan terpilih
        $allExpenseCategories = ExpenseCategory::all();
        
        foreach ($allExpenseCategories as $category) {
            $categoryExpenses = Expense::with('category')
                ->where('expense_category_id', $category->id)
                ->whereYear('expense_date', $selectedYear)
                ->whereMonth('expense_date', $selectedMonth)
                ->orderBy('expense_date', 'desc')
                ->get()
                ->map(function($expense) {
                    return [
                        'id' => $expense->id,
                        'description' => $expense->description,
                        'amount' => $expense->amount,
                        'expense_date' => $expense->expense_date->format('Y-m-d'),
                        'notes' => $expense->notes ?? '-'
                    ];
                });
            
            $expenseDetails[$category->id] = $categoryExpenses;
        }
        
        // Data untuk filter bulan dan tahun
        $years = range(now()->year - 5, now()->year);
        $months = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April', 
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus', 
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];

        return view('admin.dashboard', compact(
            'roomStats',
            'bookingStats',
            'financialStats',
            'recentBookings',
            'recentExpenses',
            'pendingPayments',
            'expenseByCategory',
            'chartData',
            'totalCustomers', 
            'customerGrowth',
            'totalRevenue', 
            'revenueGrowth',
            'totalOrders', 
            'orderDecline',
            'totalExpenseCount', 
            'expenseCountGrowth',
            'salesData', 
            'selectedMonth',
            'selectedYear',
            'years',
            'months',
            'roomCategories',
            'expenses',
            'totalExpenseAmount',
            'totalRoomRevenue',
            'expenseDetails',
            'allExpenseCategories'
        ));
    }
} 