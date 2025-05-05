<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Expense;
use App\Models\ExpenseCategory;
use App\Models\Payment;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Data untuk statistik kamar
        $roomStats = [
            'total' => Room::count(),
            'available' => Room::where('room_status', 'Available')->count(),
            'booked' => Room::where('room_status', 'Booked')->count(),
            'maintenance' => Room::where('room_status', 'Maintenance')->count(),
        ];

        // Data untuk statistik booking
        $bookingStats = [
            'total' => Booking::count(),
            'pending' => Booking::where('booking_status', 'Pending')->count(),
            'confirmed' => Booking::where('booking_status', 'Confirmed')->count(),
            'cancelled' => Booking::where('booking_status', 'Cancelled')->count(),
        ];

        // Data untuk statistik keuangan bulan ini
        $currentMonth = date('m');
        $currentYear = date('Y');

        $income = Booking::where('booking_status', 'Confirmed')
            ->whereYear('created_at', $currentYear)
            ->whereMonth('created_at', $currentMonth)
            ->sum('total_price');

        $expense = Expense::whereYear('expense_date', $currentYear)
            ->whereMonth('expense_date', $currentMonth)
            ->sum('amount');

        $financialStats = [
            'income' => $income,
            'expense' => $expense,
            'profit' => $income - $expense
        ];

        // Data transaksi terbaru
        $recentBookings = Booking::with(['room', 'payment'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Data pengeluaran terbaru
        $recentExpenses = Expense::with('category')
            ->orderBy('expense_date', 'desc')
            ->limit(5)
            ->get();

        // Data pembayaran yang menunggu konfirmasi
        $pendingPayments = Payment::with(['booking', 'masterPayment'])
            ->where('payment_status', 'Pending')
            ->whereHas('booking')
            ->count();

        // Data untuk grafik pengeluaran berdasarkan kategori
        $expenseByCategory = ExpenseCategory::select('expense_categories.name', 'expense_categories.color', DB::raw('SUM(expenses.amount) as total'))
            ->leftJoin('expenses', 'expense_categories.id', '=', 'expenses.expense_category_id')
            ->whereYear('expenses.expense_date', $currentYear)
            ->whereMonth('expenses.expense_date', $currentMonth)
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

        return view('admin.dashboard', compact(
            'roomStats',
            'bookingStats',
            'financialStats',
            'recentBookings',
            'recentExpenses',
            'pendingPayments',
            'expenseByCategory',
            'chartData'
        ));
    }
} 