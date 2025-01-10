<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'amount' => 'required|numeric',
        ]);

        $bookingId = $request->input('booking_id');
        $amountPaid = $request->input('amount');


        // Simpan pembayaran
        $payment = new Payment();
        $payment->booking_id = $bookingId;
        $payment->amount = $amountPaid;
        $payment->save();

        // Redirect ke halaman reservasi dengan pesan sukses
        return redirect()->route('reservations.show', $bookingId)->with('success', 'Payment created successfully.');
    }
}
