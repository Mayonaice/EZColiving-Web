<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\ExpenseCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ExpenseController extends Controller
{
    public function index(Request $request)
    {
        $query = Expense::with('category');

        if ($request->filled('category')) {
            $query->where('expense_category_id', $request->category);
        }

        if ($request->filled('start_date')) {
            $query->where('expense_date', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->where('expense_date', '<=', $request->end_date);
        }

        $expenses = $query->orderBy('expense_date', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        $categories = ExpenseCategory::orderBy('name')->get();
        $totalAmount = $query->sum('amount');

        return view('expenses.index', compact('expenses', 'categories', 'totalAmount'));
    }

    public function create()
    {
        $categories = ExpenseCategory::orderBy('name')->get();
        return view('expenses.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'expense_category_id' => 'required|exists:expense_categories,id',
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'expense_date' => 'required|date',
            'proof_image' => 'nullable|image|max:2048', // Max 2MB
            'notes' => 'nullable|string',
        ]);

        if ($request->hasFile('proof_image')) {
            $path = $request->file('proof_image')->store('expenses', 'public');
            $validated['proof_image'] = $path;
        }

        Expense::create($validated);

        return redirect()->route('expenses.index')
            ->with('success', 'Pengeluaran berhasil ditambahkan.');
    }

    public function edit(Expense $expense)
    {
        $categories = ExpenseCategory::orderBy('name')->get();
        return view('expenses.edit', compact('expense', 'categories'));
    }

    public function update(Request $request, Expense $expense)
    {
        $validated = $request->validate([
            'expense_category_id' => 'required|exists:expense_categories,id',
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'expense_date' => 'required|date',
            'proof_image' => 'nullable|image|max:2048',
            'notes' => 'nullable|string',
        ]);

        if ($request->hasFile('proof_image')) {
            if ($expense->proof_image) {
                Storage::disk('public')->delete($expense->proof_image);
            }
            $path = $request->file('proof_image')->store('expenses', 'public');
            $validated['proof_image'] = $path;
        }

        $expense->update($validated);

        return redirect()->route('expenses.index')
            ->with('success', 'Pengeluaran berhasil diperbarui.');
    }

    public function destroy(Expense $expense)
    {
        if ($expense->proof_image) {
            Storage::disk('public')->delete($expense->proof_image);
        }

        $expense->delete();

        return redirect()->route('expenses.index')
            ->with('success', 'Pengeluaran berhasil dihapus.');
    }

    public function report(Request $request)
    {
        $year = $request->get('year', date('Y'));
        $month = $request->get('month', date('m'));

        $expenses = Expense::with('category')
            ->whereYear('expense_date', $year)
            ->whereMonth('expense_date', $month)
            ->get();

        $categoryTotals = $expenses->groupBy('category.name')
            ->map(function ($items) {
                return $items->sum('amount');
            });

        $dailyTotals = $expenses->groupBy(function ($item) {
            return $item->expense_date->format('Y-m-d');
        })->map(function ($items) {
            return $items->sum('amount');
        });

        return view('expenses.report', compact(
            'expenses',
            'categoryTotals',
            'dailyTotals',
            'year',
            'month'
        ));
    }
} 