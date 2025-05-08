<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DamageCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DamageCategoryController extends Controller
{
    public function index()
    {
        $categories = DamageCategory::latest()->paginate(10);
        return view('admin.damage-category.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.damage-category.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        DamageCategory::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.damage-categories.index')
            ->with('success', 'Kategori kerusakan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $category = DamageCategory::findOrFail($id);
        return view('admin.damage-category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $category = DamageCategory::findOrFail($id);
        $category->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.damage-categories.index')
            ->with('success', 'Kategori kerusakan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        try {
            $category = DamageCategory::findOrFail($id);
            $category->delete();
            return redirect()->route('admin.damage-categories.index')
                ->with('success', 'Kategori kerusakan berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('admin.damage-categories.index')
                ->with('error', 'Gagal menghapus kategori kerusakan.');
        }
    }
} 