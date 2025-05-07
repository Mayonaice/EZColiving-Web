<?php

namespace App\Http\Controllers;

use App\Models\ExpenseCategory;
use Illuminate\Http\Request;

class ExpenseCategoryController extends Controller
{
    public function index()
    {
        $categories = ExpenseCategory::withCount('expenses')
            ->withSum('expenses', 'amount')
            ->orderBy('name')
            ->get();

        return view('expenses.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('expenses.categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:expense_categories',
            'description' => 'nullable|string|max:255',
            'color' => 'nullable|string|max:7',
        ]);

        ExpenseCategory::create($validated);

        return redirect()->route('expense-categories.index')
            ->with('success', 'Kategori pengeluaran berhasil ditambahkan.');
    }

    public function edit(ExpenseCategory $expenseCategory)
    {
        return view('expenses.categories.edit', compact('expenseCategory'));
    }

    public function update(Request $request, ExpenseCategory $expenseCategory)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:expense_categories,name,' . $expenseCategory->id,
            'description' => 'nullable|string|max:255',
            'color' => 'nullable|string|max:7',
        ]);

        $expenseCategory->update($validated);

        return redirect()->route('expense-categories.index')
            ->with('success', 'Kategori pengeluaran berhasil diperbarui.');
    }

    public function destroy(ExpenseCategory $expenseCategory)
    {
        if ($expenseCategory->expenses()->exists()) {
            return redirect()->route('expense-categories.index')
                ->with('error', 'Kategori ini tidak dapat dihapus karena masih memiliki data pengeluaran.');
        }

        $expenseCategory->delete();

        return redirect()->route('expense-categories.index')
            ->with('success', 'Kategori pengeluaran berhasil dihapus.');
    }
} 