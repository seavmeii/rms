@extends('layouts.admin') {{-- Use your admin layout --}}

@section('title', 'All Orders')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h2 class="text-3xl font-bold mb-6">All Orders</h2>

    @if($orders && $orders->count() > 0)
    <div class="grid gap-6">
        @foreach($orders as $order)
        <div class="bg-white border rounded-lg shadow p-6 hover:shadow-lg transition">

            <!-- Header -->
            <div class="flex justify-between items-center mb-4">
                <div>
                    <span class="font-semibold text-gray-700">
                        Order #{{ $order->id }}
                    </span>
                    <span class="text-gray-500 text-sm">
                        ({{ $order->created_at->format('M d, Y H:i') }})
                    </span>
                </div>
                <div>
                    <span class="font-semibold text-gray-600">
                        User ID: {{ $order->user_id }}
                    </span>
                </div>
            </div>

            <!-- Total -->
            <p>
                <strong>Total:</strong>
                ${{ number_format($order->total_price, 2) }}
            </p>

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

            <!-- Items -->
            @if($order->cart_items)
            <div class="mt-3">
                <strong>Items:</strong>
                <ul class="list-disc list-inside mt-1">
                    @foreach(json_decode($order->cart_items, true) as $item)
                    <li>
                        {{ $item['name'] }}
                        (x{{ $item['quantity'] }})
                        - ${{ number_format($item['price'], 2) }}
                    </li>
                    @endforeach
                </ul>
            </div>
            @endif

            <!-- Actions -->
            <div class="flex gap-3 mt-4">

                <!-- Edit -->
                <a href="{{ route('admin.orders.edit', $order->id) }}"
                    class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                    Edit Status
                </a>

                <!-- Delete -->
                <form action="{{ route('admin.orders.destroy', $order->id) }}"
                    method="POST"
                    onsubmit="return confirm('Are you sure you want to delete this order?');">

                    @csrf
                    @method('DELETE')

                    <button type="submit"
                        class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                        Delete
                    </button>
                </form>

            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="text-center mt-10 text-gray-500">
        No orders found.
    </div>
    @endif
</div>
@endsection