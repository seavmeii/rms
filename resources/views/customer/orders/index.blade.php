@extends('layouts.app')

@section('title', 'My Orders')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h2 class="text-3xl font-bold mb-6">My Orders</h2>
    

    @if($orders && $orders->count() > 0)
        <div class="grid gap-6">
            @foreach($orders as $order)
            <div class="bg-white border rounded-lg shadow p-6 hover:shadow-lg transition duration-200">

                <!-- Header: Order ID and Date -->
                <div class="flex justify-between items-center mb-4">
                    <div>
                        <span class="font-semibold text-gray-700">Order #{{ $order->id }}</span>
                        <span class="text-gray-500 text-sm ml-2">({{ $order->created_at->format('M d, Y H:i') }})</span>
                    </div>
                    <div>
                        <span class="font-semibold text-gray-600">Total: ${{ number_format($order->total_price, 2) }}</span>
                    </div>
                </div>

        
                    <!-- Status -->
            <p class="mt-2">
                <strong>Status:</strong>
                <span class="px-2 py-1 rounded-full text-sm 
                        {{ $order->status == 'preparing' ? 'bg-blue-100 text-blue-700' : '' }}
                        {{ $order->status == 'completed' ? 'bg-green-100 text-green-700' : '' }}
                        {{ $order->status == 'cancelled' ? 'bg-red-100 text-red-700' : '' }}
                        {{ !in_array($order->status, ['preparing','completed','cancelled']) ? 'bg-gray-100 text-gray-700' : '' }}">

                    {{ ucfirst($order->status) }}
                </span>
            </p>

                <!-- Items List -->
                @if($order->cart_items)
                <div class="mt-3">
                    <strong>Items:</strong>
                    <ul class="list-disc list-inside mt-1">
                        @foreach(json_decode($order->cart_items, true) as $item)
                            <li>{{ $item['name'] }} (x{{ $item['quantity'] }}) - ${{ number_format($item['price'], 2) }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <!-- Action Buttons -->
                <div class="flex gap-3 mt-4">
                    @if($order->status !== 'paid' && $order->payment_status !== 'approved')
                        <!-- Checkout button -->
                        <form action="{{ route('customer.cart.index') }}" method="GET">
                            <input type="hidden" name="tran_id" value="{{ $order->tran_id }}">
                            <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">
                                Proceed to Checkout
                            </button>
                        </form>

                        <!-- Cancel order button -->
                        <form action="{{ route('customer.orders.cancel', $order->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to cancel this order?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                                Cancel Order
                            </button>
                        </form>
                    @else
                        <!-- Completed/approved badge -->
                        <span class="px-4 py-2 bg-gray-200 text-gray-700 rounded">Completed</span>
                    @endif
                </div>

            </div>
            @endforeach
        </div>
    @else
        <div class="text-center mt-10 text-gray-500">
            You have no orders yet.
            <a href="{{ route('customer.foods.index') }}" class="inline-block mt-3 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                Continue Shopping
            </a>
        </div>
    @endif
</div>
@endsection