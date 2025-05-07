<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use App\Models\ExpenseCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Expense::with('category')->orderBy('expense_date', 'desc');

        // Filter by month
        if ($request->filled('month')) {
            $query->whereMonth('expense_date', $request->month);
        }

        // Filter by year
        if ($request->filled('year')) {
            $query->whereYear('expense_date', $request->year);
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->where('expense_category_id', $request->category);
        }

        $expenses = $query->paginate(10);
        $categories = ExpenseCategory::orderBy('name')->get();
        
        // Get years for filter
        $years = Expense::selectRaw('YEAR(expense_date) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');

        return view('admin.expenses.index', compact('expenses', 'categories', 'years'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = ExpenseCategory::orderBy('name')->get();
        return view('admin.expenses.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'expense_category_id' => 'required|exists:expense_categories,id',
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'expense_date' => 'required|date',
            'receipt_image' => 'nullable|image|max:2048',
            'notes' => 'nullable|string'
        ]);

        $data = $request->all();

        if ($request->hasFile('receipt_image')) {
            $path = $request->file('receipt_image')->store('expenses', 'public');
            $data['receipt_image'] = $path;
        }

        Expense::create($data);

        return redirect()->route('admin.expenses.index')
            ->with('success', 'Pengeluaran berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Expense $expense)
    {
        $categories = ExpenseCategory::orderBy('name')->get();
        return view('admin.expenses.edit', compact('expense', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Expense $expense)
    {
        $request->validate([
            'expense_category_id' => 'required|exists:expense_categories,id',
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'expense_date' => 'required|date',
            'receipt_image' => 'nullable|image|max:2048',
            'notes' => 'nullable|string'
        ]);

        $data = $request->all();

        if ($request->hasFile('receipt_image')) {
            // Delete old image
            if ($expense->receipt_image) {
                Storage::disk('public')->delete($expense->receipt_image);
            }
            
            $path = $request->file('receipt_image')->store('expenses', 'public');
            $data['receipt_image'] = $path;
        }

        $expense->update($data);

        return redirect()->route('admin.expenses.index')
            ->with('success', 'Pengeluaran berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Expense $expense)
    {
        if ($expense->receipt_image) {
            Storage::disk('public')->delete($expense->receipt_image);
        }

        $expense->delete();

        return redirect()->route('admin.expenses.index')
            ->with('success', 'Pengeluaran berhasil dihapus.');
    }
}
