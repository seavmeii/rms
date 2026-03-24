<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ReceiptController extends Controller
{
    /**
     * Show the upload form for a specific order (for customers)
     */
    public function create($orderId)
    {
        // Ensure customer owns this order
        $order = Order::where('id', $orderId)
                      ->where('user_id', Auth::id())
                      ->firstOrFail();

        // Return the upload form
        return view('customer.receipts.upload', compact('order'));
    }

    /**
     * Store uploaded receipt and update order
     */
    public function store(Request $request, $orderId)
    {
        // Ensure customer owns this order
        $order = Order::where('id', $orderId)
                      ->where('user_id', Auth::id())
                      ->firstOrFail();

        // Validate uploaded file
        $request->validate([
            'receipt' => 'required|file|mimes:pdf|max:2048', // Only PDF 
        ]);

        // Store the uploaded PDF in storage/app/public/receipts
        $path = $request->file('receipt')->store('receipts', 'public');

        // Save the path in the orders table
        $order->receipt = $path;
        $order->save();

        return redirect()->route('customer.orders.index')
                         ->with('success', 'Receipt uploaded successfully.');
    }
}