@extends('layouts.admin')

@section('header', 'Admin Dashboard')

@section('content')

<div class="space-y-6">

    <!-- Greeting -->
    <div class="bg-white shadow rounded p-6">
        <h2 class="text-2xl font-bold text-gray-700">
            Welcome back, {{ Auth::user()->name }} 👋
        </h2>

        <p class="text-gray-500 mt-2">
            Here is a quick summary of your restaurant system today.
        </p>
    </div>


    <!-- Summary Cards -->
    <div class="grid grid-cols-3 gap-6">

        <div class="bg-white shadow rounded p-5">
            <p class="text-gray-500 text-sm">Total Orders</p>
            <p class="text-3xl font-bold text-blue-600">{{ $totalOrders }}</p>
        </div>

        <div class="bg-white shadow rounded p-5">
            <p class="text-gray-500 text-sm">Menu Items</p>
            <p class="text-3xl font-bold text-green-600">{{ $totalMenuItems }}</p>
        </div>

        <div class="bg-white shadow rounded p-5">
            <p class="text-gray-500 text-sm">Total Customers</p>
            <p class="text-3xl font-bold text-purple-600">{{ $totalCustomers }}</p>
        </div>

    </div>


    <!-- Recent Orders -->
    <div class="bg-white shadow rounded p-6">

        <h3 class="text-lg font-bold text-gray-700 mb-4">
            Recent Orders
        </h3>

        <table class="w-full">

            <thead>
                <tr class="border-b text-left text-gray-600">
                    <th class="p-2">Order</th>
                    <th class="p-2">Customer</th>
                    <th class="p-2">Total</th>
                    <th class="p-2">Date</th>
                </tr>
            </thead>

            <tbody>

                @foreach($recentOrders as $order)

                <tr class="border-b">

                    <td class="p-2">#{{ $order->id }}</td>

                    <td class="p-2">
                        {{ $order->user->name ?? 'Unknown' }}
                    </td>

                    <td class="p-2">
                        ${{ number_format($order->total_price,2) }}
                    </td>

                    <td class="p-2">
                        {{ $order->created_at->format('d M Y') }}
                    </td>

                </tr>

                @endforeach

            </tbody>

        </table>

        <div class="mt-4">

            <a href="{{ route('admin.orders.index') }}"
                class="text-blue-600 hover:underline">

                View all orders →

            </a>

        </div>

    </div>

</div>

@endsection