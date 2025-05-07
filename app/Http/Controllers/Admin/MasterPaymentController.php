<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MasterPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MasterPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $masterpayments = MasterPayment::latest()->paginate(10);
        return view('admin.masterpayments.index', compact('masterpayments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.masterpayments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'payment_name' => 'required|string|max:255',
            'payment_type' => 'required|string|max:255',
            'payment_account_number' => 'required|string|max:255',
            'payment_qrcode' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'payment_status' => 'required|in:Active,Inactive',
        ]);

        $data = $request->except('payment_qrcode');

        if ($request->hasFile('payment_qrcode')) {
            $qrcode = $request->file('payment_qrcode');
            $filename = 'qrcode_' . time() . '.' . $qrcode->getClientOriginalExtension();
            $qrcode->storeAs('masterpayments', $filename, 'public');
            $data['payment_qrcode'] = $filename;
        }

        MasterPayment::create($data);

        return redirect()->route('admin.masterpayments.index')
            ->with('success', 'Metode pembayaran berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(MasterPayment $masterpayment)
    {
        return view('admin.masterpayments.show', compact('masterpayment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MasterPayment $masterpayment)
    {
        return view('admin.masterpayments.edit', compact('masterpayment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MasterPayment $masterpayment)
    {
        $request->validate([
            'payment_name' => 'required|string|max:255',
            'payment_type' => 'required|string|max:255',
            'payment_account_number' => 'required|string|max:255',
            'payment_qrcode' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'payment_status' => 'required|in:Active,Inactive',
        ]);

        $data = $request->except('payment_qrcode');

        if ($request->hasFile('payment_qrcode')) {
            // Hapus QR code lama jika ada
            if ($masterpayment->payment_qrcode) {
                Storage::disk('public')->delete('masterpayments/' . $masterpayment->payment_qrcode);
            }

            $qrcode = $request->file('payment_qrcode');
            $filename = 'qrcode_' . time() . '.' . $qrcode->getClientOriginalExtension();
            $qrcode->storeAs('masterpayments', $filename, 'public');
            $data['payment_qrcode'] = $filename;
        }

        $masterpayment->update($data);

        return redirect()->route('admin.masterpayments.index')
            ->with('success', 'Metode pembayaran berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MasterPayment $masterpayment)
    {
        // Hapus file QR code jika ada
        if ($masterpayment->payment_qrcode) {
            Storage::disk('public')->delete('masterpayments/' . $masterpayment->payment_qrcode);
        }

        $masterpayment->delete();

        return redirect()->route('admin.masterpayments.index')
            ->with('success', 'Metode pembayaran berhasil dihapus!');
    }
} 