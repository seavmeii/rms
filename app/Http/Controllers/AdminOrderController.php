<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class AdminOrderController extends Controller
{

    // Show all orders
    public function index()
    {
        $orders = Order::with('user')->latest()->get();

        return view('admin.orders.index', compact('orders'));
    }


    // Show edit page
    public function edit(Order $order)
    {
        return view('admin.orders.edit', compact('order'));
    }


    // Update order status
    public function update(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required'
        ]);

        $order->update([
            'status' => $request->status
        ]);

        return redirect()
            ->route('admin.orders.index')
            ->with('success', 'Order status updated successfully!');
    }

    /// delete order//
    // Delete order
public function destroy(Order $order)
{
    $order->delete();

    return redirect()
        ->route('admin.orders.index')
        ->with('success', 'Order deleted successfully!');
}

}