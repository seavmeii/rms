@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

    <!-- Hero Welcome -->
    <div class="relative rounded-xl overflow-hidden mb-6">
        <img src="/images/restaurant.jpg" class="w-full h-56 object-cover">
        <div class="absolute inset-0 bg-black/60 flex flex-col justify-center px-6">
            <h2 class="text-3xl font-bold text-white">
                Welcome back, {{ Auth::user()->name }} 👋
            </h2>
            <p class="text-gray-200 mt-2">
                Ready to enjoy something delicious today?
            </p>
            <a href="{{ route('customer.foods.index') }}"
                class="mt-4 w-fit px-6 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg shadow">
                🍽️ Order Now
            </a>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">

        <!-- Menu -->
        <a href="{{ route('customer.foods.index') }}"
            class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition group">
            <div class="flex items-center gap-4">
                <div class="p-3 bg-red-100 text-red-500 rounded-lg group-hover:bg-red-500 group-hover:text-white transition">
                    <i class="bi bi-list-ul text-2xl"></i>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-800">Browse Menu</h3>
                    <p class="text-gray-500 text-sm">Explore delicious meals</p>
                </div>
            </div>
        </a>

        <!-- Orders -->
        <a href="{{ route('customer.orders.index') }}"
            class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition group">
            <div class="flex items-center gap-4">
                <div class="p-3 bg-blue-100 text-blue-500 rounded-lg group-hover:bg-blue-500 group-hover:text-white transition">
                    <i class="bi bi-receipt text-2xl"></i>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-800">My Orders</h3>
                    <p class="text-gray-500 text-sm">Track your orders</p>
                </div>
            </div>
        </a>

        <!-- Account -->
        <div class="bg-white p-6 rounded-xl shadow">
            <div class="flex items-center gap-4">
                <div class="p-3 bg-yellow-100 text-yellow-500 rounded-lg">
                    <i class="bi bi-person-check text-2xl"></i>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-800">Account Status</h3>
                    <p class="text-green-500 text-sm font-medium">Active</p>
                </div>
            </div>
        </div>

    </div>

    <!-- Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">

        <div class="bg-white p-6 rounded-xl shadow text-center">
            <h4 class="text-gray-500 text-sm">Total Orders</h4>
            <p class="text-3xl font-bold text-gray-800 mt-2">
                {{ Auth::user()->orders()->count() }}
            </p>
        </div>


        <div class="bg-white p-6 rounded-xl shadow text-center">
            <h4 class="text-gray-500 text-sm">Pending Orders</h4>
            <p class="text-3xl font-bold text-yellow-500 mt-2">
                0
            </p>
        </div>

    </div>
    <!-- Featured Food Preview -->
    <div class="bg-white p-7 rounded-xl shadow">
        <h3 class="text-xl font-bold text-gray-800 mb-4">🔥 Popular Dishes</h3>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <div class="rounded-lg overflow-hidden shadow hover:shadow-lg transition">
                <img src="/images/burger.jpg" class="h-52 w-full object-cover">
                <div class="p-4">
                    <h4 class="font-semibold">Beef Burger</h4>
                    <p class="text-sm text-gray-500">Juicy & flavorful</p>
                </div>
            </div>

            <div class="rounded-lg overflow-hidden shadow hover:shadow-lg transition">
                <img src="/images/fries.jpg" class="h-52 w-full object-cover">
                <div class="p-4">
                    <h4 class="font-semibold">French Fries</h4>
                    <p class="text-sm text-gray-500">Customer favorite</p>
                </div>
            </div>

            <div class="rounded-lg overflow-hidden shadow hover:shadow-lg transition">
                <img src="/images/papayasalad.webp" class="h-52 w-full object-cover">
                <div class="p-4">
                    <h4 class="font-semibold">Fresh Papaya Salad</h4>
                    <p class="text-sm text-gray-500">Healthy choice</p>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection