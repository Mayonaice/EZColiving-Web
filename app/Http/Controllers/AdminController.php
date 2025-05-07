<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Room;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\Expense;
use App\Models\ExpenseCategory;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function home() {
        $listadmin = User::where('role', 'admin')->get();
        return view('admin.home', compact('listadmin'));
    }
    
    public function dashboard() {
        // Statistik umum
        $totalCustomers = User::where('role', 'user')->count();
        $totalRevenue = Payment::where('payment_status', 'Confirmed')
                            ->whereYear('created_at', now()->year)
                            ->sum('payment_amount');
        $totalOrders = Booking::count();
        $totalReturns = Booking::where('booking_status', 'Cancelled')->count();
        
        // Growth percentages (placeholder - implement real calculation)
        $customerGrowth = 2.5; // Placeholder - implement based on previous month
        $revenueGrowth = 0.5; // Placeholder
        $orderDecline = -0.2; // Placeholder
        $returnGrowth = 0.12; // Placeholder
        
        // Produk sales data - menggunakan data booking berdasarkan bulan
        $currentYear = now()->year;
        $salesData = [];
        
        for ($month = 1; $month <= 12; $month++) {
            // Pendapatan per bulan
            $revenue = Payment::where('payment_status', 'Confirmed')
                ->whereYear('created_at', $currentYear)
                ->whereMonth('created_at', $month)
                ->sum('payment_amount');
                
            // Gross margin (pendapatan - pengeluaran)
            $expenses = Expense::whereYear('expense_date', $currentYear)
                ->whereMonth('expense_date', $month)
                ->sum('amount');
                
            $grossMargin = $revenue - $expenses;
            
            $salesData[$month] = [
                'month' => Carbon::create($currentYear, $month, 1)->format('M'),
                'revenue' => $revenue,
                'grossMargin' => $grossMargin
            ];
        }
        
        // Gross margin untuk highlight
        $currentMonthGrossMargin = $salesData[now()->month]['grossMargin'];
        $grossMarginGrowth = 2.5; // Placeholder - implement actual growth calculation
        
        // Sales by product category
        $expenseCategories = ExpenseCategory::withCount(['expenses' => function($query) {
                                    $query->whereYear('expense_date', now()->year);
                                }])
                                ->withSum(['expenses' => function($query) {
                                    $query->whereYear('expense_date', now()->year);
                                }], 'amount')
                                ->get();
                                
        $categories = [];
        $totalExpenses = $expenseCategories->sum('expenses_sum_amount') ?: 1; // Avoid div by zero
        
        foreach ($expenseCategories as $category) {
            $percentage = ($category->expenses_sum_amount / $totalExpenses) * 100;
            $categories[] = [
                'name' => $category->name,
                'percentage' => round($percentage, 0)
            ];
        }
        
        // Sales by countries (placeholder - implement based on your data model)
        $countries = [
            ['name' => 'Poland', 'percentage' => 19],
            ['name' => 'Austria', 'percentage' => 15],
            ['name' => 'Spain', 'percentage' => 13],
            ['name' => 'Romania', 'percentage' => 12],
            ['name' => 'France', 'percentage' => 11],
            ['name' => 'Italy', 'percentage' => 11],
            ['name' => 'Germany', 'percentage' => 10],
            ['name' => 'Ukraine', 'percentage' => 9]
        ];
        
        return view('admin.dashboard', compact(
            'totalCustomers', 
            'customerGrowth',
            'totalRevenue', 
            'revenueGrowth',
            'totalOrders', 
            'orderDecline',
            'totalReturns', 
            'returnGrowth',
            'salesData', 
            'currentMonthGrossMargin',
            'grossMarginGrowth',
            'categories',
            'countries'
        ));
    }
    
    public function denah() {
        // Mengambil semua data kamar
        $rooms = Room::all()->map(function($room) {
            // Menggunakan room_number yang sudah dalam format denah (1BE, 2AA, dll)
            return [
                'id' => $room->id,
                'room_number' => $room->room_number,
                'room_name' => $room->room_name,
                'room_type' => $room->room_type,
                'room_price' => $room->room_price,
                'room_status' => $room->room_status,
                'room_description' => $room->room_description
            ];
        })->values(); // Menggunakan values() untuk memastikan data dalam bentuk array
        
        return view('admin.denah.denah', compact('rooms'));
    }
}
