<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Services\PayWayService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CartController extends Controller
{
    protected $payWayService;

    public function __construct(PayWayService $payWayService)
    {
        $this->payWayService = $payWayService;
    }

    // Place order (before payment)
    public function placeOrderJs(Request $request)
    {
        $cartJson = html_entity_decode($request->cart_data);
        $cart = json_decode($cartJson, true);

        if (!$cart || count($cart) == 0) {
            return back()->with('error', 'Cart is empty.');
        }

        $totalQty = array_sum(array_map(fn($item) => $item['quantity'], $cart));
        $totalPrice = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart));

        $tranId = 'ORD-' . time() . '-' . Str::random(5);

        $order = Order::create([
            'user_id' => Auth::id(),
            'quantity' => $totalQty,
            'total_price' => $totalPrice,
            'status' => 'pending',          // waiting for payment
            'payment_status' => 'pending',  // waiting for payment
            'tran_id' => $tranId,
            'cart_items' => json_encode($cart),
            'req_time' => time(),
        ]);

        // Redirect to payment page (pass tran_id)
        return redirect()->route('customer.orders.index', ['tran_id' => $tranId])
                         ->with('success', 'Order placed successfully. Proceed to payment.');
    }

    // Cart index (show payment page for this order)
    public function index(Request $request)
    {
        $tranId = $request->tran_id;
        $order = Order::where('tran_id', $tranId)->firstOrFail();
        $cart = json_decode($order->cart_items, true);
        $total = $order->total_price;

        $merchant_id    = 'ec463541';
        $req_time       = time();
        $amount         = number_format($total, 2, '.', '');
        $currency       = 'USD';
        $payment_option = '';

        $hash = $this->payWayService->getHash(
            $req_time . $merchant_id . $tranId . $amount . $payment_option . $currency
        );

        return view('customer.cart.index', compact(
            'cart', 'total', 'hash', 'tranId', 'amount',
            'payment_option', 'merchant_id', 'req_time', 'currency'
        ));
    }

    // Show customer orders
    public function myOrders()
    {
        $orders = Order::where('user_id', Auth::id())
                       ->latest()
                       ->get();

        return view('customer.orders.index', compact('orders'));
    }

    // Cancel order
    public function cancelOrder($id)
    {
        $order = Order::where('user_id', Auth::id())
                      ->where('id', $id)
                      ->firstOrFail();

        if ($order->status === 'paid') {
            return back()->with('error', 'Paid orders cannot be canceled.');
        }

        $order->delete();
        return back()->with('success', 'Order canceled successfully.');
    }
}