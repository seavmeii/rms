<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Restaurant System') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Playfair+Display:wght@600&display=swap" rel="stylesheet">
</head>

<body class="min-h-screen flex font-[Poppins] bg-gray-100">

<!-- Sidebar -->
<aside class="w-64 bg-gradient-to-b from-[#1a1a1a] to-[#3b1d1d] text-white flex flex-col shadow-lg">

    <!-- Logo -->
    <div class="px-6 py-5 border-b border-gray-700">
        <h1 class="text-xl font-bold tracking-wide">🌸 Flower Restaurant</h1>
    </div>

    <!-- User -->
    <div class="flex flex-col items-center py-6 border-b border-gray-700">
        <i class="bi bi-person-circle text-5xl text-gray-300"></i>
        <span class="mt-2 text-sm font-semibold">{{ Auth::user()->name ?? 'Guest' }}</span>

        <div class="mt-4 flex gap-2">
            <a href="{{ route('profile.edit') }}"
                class="px-3 py-1 text-xs bg-white text-black rounded hover:bg-gray-200">
                Edit
            </a>

            @auth
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="px-3 py-1 text-xs bg-red-500 rounded hover:bg-red-600">
                    Logout
                </button>
            </form>
            @endauth
        </div>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 px-4 py-6 space-y-2 text-sm">

        <a href="{{ route('customer.dashboard') }}"
            class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-white hover:text-black transition">
            <i class="bi bi-house-door-fill"></i> Dashboard
        </a>

        <a href="{{ route('customer.foods.index') }}"
            class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-white hover:text-black transition">
            <i class="bi bi-grid-fill"></i> Menu
        </a>

        <a href="{{ route('customer.orders.index') }}"
            class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-white hover:text-black transition">
            <i class="bi bi-receipt"></i> My Orders
        </a>

    </nav>

    <!-- Footer -->
    <div class="px-4 py-3 text-xs text-center text-gray-400 border-t border-gray-700">
        © {{ date('Y') }} Flower Restaurant
    </div>
</aside>

<!-- Main -->
<main class="flex-1 flex flex-col min-h-screen">

    <!-- Header -->
    <header class="bg-white px-6 py-4 flex justify-between items-center shadow">

        <div>
            <h1 class="text-2xl font-bold text-gray-800">
                Welcome back, {{ Auth::user()->name ?? 'Guest' }} 👋
            </h1>
            <p class="text-gray-500 text-sm">
                What would you like to eat today?
            </p>
        </div>

        <!-- Profile dropdown -->
        <div class="relative" x-data="{ open: false }">
            <button @click="open = !open"
                class="flex items-center gap-2 px-4 py-2 bg-gray-100 rounded-lg hover:bg-gray-200 transition">
                <i class="bi bi-person-circle text-xl"></i>
                <span class="font-medium">{{ Auth::user()->name ?? 'Guest' }}</span>
                <i class="bi bi-caret-down-fill"></i>
            </button>

            <div x-show="open" @click.outside="open = false"
                class="absolute right-0 mt-2 w-44 bg-white border rounded-lg shadow-lg py-2 z-10">

                <a href="{{ route('profile.edit') }}"
                    class="block px-4 py-2 hover:bg-gray-100">Profile</a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="w-full text-left px-4 py-2 hover:bg-gray-100">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </header>

    <!-- Content -->
    <div class="flex-1 px-6 py-8 bg-gray-50">
        @yield('content')
    </div>

</main>

<style>
    [x-cloak] {
        display: none !important;
    }
</style>

</body>
</html>