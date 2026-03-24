<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class PaymentController extends Controller
{
    // ABA payment webhook
    public function handleNotification(Request $request)
    {
        // ABA will send tran_id, aba_tran_id, status, etc.
        $tranId = $request->input('tran_id');
        $abaTranId = $request->input('aba_tran_id');
        $status = $request->input('status'); // e.g., 'success'

        $order = Order::where('tran_id', $tranId)->first();

        if (!$order) {
            return response()->json(['error' => 'Order not found'], 404);
        }

        // Only update if payment successful
        if ($status === 'success') {
            $order->update([
                'payment_status' => 'paid',
                'status' => 'completed', // or 'preparing' depending on your workflow
                'aba_tran_id' => $abaTranId,
            ]);
        }

        // ABA usually expects a 200 OK response
        return response()->json(['success' => true]);
    }
}