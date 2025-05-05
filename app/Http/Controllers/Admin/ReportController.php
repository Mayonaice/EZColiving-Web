<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use App\Models\ExpenseCategory;
use App\Models\Room;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ReportController extends Controller
{
    public function index()
    {
        // Get years for filter
        $years = Booking::selectRaw('YEAR(created_at) as year')
            ->union(Expense::selectRaw('YEAR(expense_date) as year'))
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');

        return view('admin.reports.index', compact('years'));
    }

    public function getData(Request $request)
    {
        $year = $request->input('year', date('Y'));
        $month = $request->input('month');

        // Income data
        $incomeQuery = Booking::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('SUM(total_price) as total')
        )
        ->whereYear('created_at', $year)
        ->where('booking_status', 'Confirmed')
        ->groupBy('month');

        // Expense data
        $expenseQuery = Expense::select(
            DB::raw('MONTH(expense_date) as month'),
            DB::raw('SUM(amount) as total')
        )
        ->whereYear('expense_date', $year)
        ->groupBy('month');

        if ($month) {
            $incomeQuery->whereMonth('created_at', $month);
            $expenseQuery->whereMonth('expense_date', $month);
        }

        $income = $incomeQuery->get()->keyBy('month');
        $expenses = $expenseQuery->get()->keyBy('month');

        // Popular rooms
        $popularRooms = Room::select('rooms.name', DB::raw('COUNT(bookings.id) as booking_count'))
            ->leftJoin('bookings', 'rooms.id', '=', 'bookings.room_id')
            ->where('bookings.booking_status', 'Confirmed')
            ->whereYear('bookings.created_at', $year)
            ->when($month, function($query) use ($month) {
                return $query->whereMonth('bookings.created_at', $month);
            })
            ->groupBy('rooms.id', 'rooms.name')
            ->orderByDesc('booking_count')
            ->limit(5)
            ->get();

        // Expense by category
        $expensesByCategory = ExpenseCategory::select(
            'expense_categories.name',
            DB::raw('SUM(expenses.amount) as total')
        )
        ->leftJoin('expenses', 'expense_categories.id', '=', 'expenses.expense_category_id')
        ->whereYear('expenses.expense_date', $year)
        ->when($month, function($query) use ($month) {
            return $query->whereMonth('expenses.expense_date', $month);
        })
        ->groupBy('expense_categories.id', 'expense_categories.name')
        ->get();

        return response()->json([
            'income' => $income,
            'expenses' => $expenses,
            'popularRooms' => $popularRooms,
            'expensesByCategory' => $expensesByCategory
        ]);
    }

    public function export(Request $request)
    {
        $year = $request->input('year', date('Y'));
        $month = $request->input('month');

        $spreadsheet = new Spreadsheet();
        
        // Income Sheet
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Laporan Keuangan');

        // Header
        $sheet->setCellValue('A1', 'Laporan Keuangan ' . ($month ? date('F', mktime(0, 0, 0, $month, 1)) . ' ' : '') . $year);
        $sheet->mergeCells('A1:E1');

        // Income section
        $sheet->setCellValue('A3', 'Pemasukan');
        $sheet->setCellValue('A4', 'Tanggal');
        $sheet->setCellValue('B4', 'Kamar');
        $sheet->setCellValue('C4', 'Jumlah');

        $row = 5;
        $bookings = Booking::with('room')
            ->whereYear('created_at', $year)
            ->when($month, function($query) use ($month) {
                return $query->whereMonth('created_at', $month);
            })
            ->where('booking_status', 'Confirmed')
            ->get();

        foreach ($bookings as $booking) {
            $sheet->setCellValue('A' . $row, $booking->created_at->format('d/m/Y'));
            $sheet->setCellValue('B' . $row, $booking->room->name);
            $sheet->setCellValue('C' . $row, $booking->total_price);
            $row++;
        }

        // Expense section
        $row += 2;
        $sheet->setCellValue('A' . $row, 'Pengeluaran');
        $row++;
        $sheet->setCellValue('A' . $row, 'Tanggal');
        $sheet->setCellValue('B' . $row, 'Kategori');
        $sheet->setCellValue('C' . $row, 'Deskripsi');
        $sheet->setCellValue('D' . $row, 'Jumlah');

        $row++;
        $expenses = Expense::with('category')
            ->whereYear('expense_date', $year)
            ->when($month, function($query) use ($month) {
                return $query->whereMonth('expense_date', $month);
            })
            ->get();

        foreach ($expenses as $expense) {
            $sheet->setCellValue('A' . $row, $expense->expense_date->format('d/m/Y'));
            $sheet->setCellValue('B' . $row, $expense->category->name);
            $sheet->setCellValue('C' . $row, $expense->description);
            $sheet->setCellValue('D' . $row, $expense->amount);
            $row++;
        }

        // Summary
        $row += 2;
        $totalIncome = $bookings->sum('total_price');
        $totalExpense = $expenses->sum('amount');
        $profit = $totalIncome - $totalExpense;

        $sheet->setCellValue('A' . $row, 'Ringkasan');
        $row++;
        $sheet->setCellValue('A' . $row, 'Total Pemasukan');
        $sheet->setCellValue('B' . $row, $totalIncome);
        $row++;
        $sheet->setCellValue('A' . $row, 'Total Pengeluaran');
        $sheet->setCellValue('B' . $row, $totalExpense);
        $row++;
        $sheet->setCellValue('A' . $row, 'Profit');
        $sheet->setCellValue('B' . $row, $profit);

        // Auto-size columns
        foreach (range('A', 'E') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // Create the Excel file
        $writer = new Xlsx($spreadsheet);
        $filename = 'laporan-keuangan-' . $year . ($month ? '-' . str_pad($month, 2, '0', STR_PAD_LEFT) : '') . '.xlsx';
        
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        
        $writer->save('php://output');
        exit;
    }
}
