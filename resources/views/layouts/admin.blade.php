<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Restaurant System') }}</title>

    @vite(['resources/css/app.css','resources/js/app.js'])

    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

</head>

<body class="min-h-screen flex font-sans bg-gray-100">


    <!-- Sidebar -->
    <aside class="w-64 bg-white shadow-md flex flex-col">


        <!-- Profile Section -->
        <div class="flex flex-col items-center py-5 border-b">

            <i class="bi bi-person-circle text-5xl text-gray-700"></i>

            <span class="mt-2 text-sm font-semibold text-gray-700">
                {{ Auth::user()->name }}
            </span>

            <div class="mt-3 flex gap-2">

                <a href="{{ route('profile.edit') }}"
                    class="px-3 py-1.5 bg-blue-500 text-white text-xs rounded hover:bg-blue-600 transition">

                    Edit

                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit"
                        class="px-3 py-1.5 bg-red-500 text-white text-xs rounded hover:bg-red-600 transition">

                        Logout

                    </button>

                </form>

            </div>

        </div>


        <!-- Navigation -->
        <nav class="flex-1 px-4 py-4 space-y-2">

            <a href="{{ route('admin.dashboard') }}"
                class="flex items-center px-3 py-2 text-gray-700 hover:bg-gray-100 rounded">

                <i class="bi bi-house-door-fill me-2"></i>

                Dashboard

            </a>


            <a href="{{ route('admin.foods.index') }}"
                class="flex items-center px-3 py-2 text-gray-700 hover:bg-gray-100 rounded">

                <i class="bi bi-list-ul me-2"></i>

                Manage Menu

            </a>


            <a href="{{ route('admin.categories.index') }}"
                class="flex items-center px-3 py-2 text-gray-700 hover:bg-gray-100 rounded">

                <i class="bi bi-tags-fill me-2"></i>

                Categories

            </a>


            <a href="{{ route('admin.orders.index') }}"
                class="flex items-center px-3 py-2 text-gray-700 hover:bg-gray-100 rounded">

                <i class="bi bi-receipt me-2"></i>

                Manage Orders

            </a>

        </nav>


        <!-- Footer -->
        <div class="px-4 py-3 text-xs text-center text-gray-400 border-t">

            © {{ date('Y') }} {{ config('app.name', 'Restaurant') }}

        </div>

    </aside>


    <!-- Main Content -->
    <main class="flex-1 flex flex-col min-h-screen px-6 py-8">


        @if(isset($header))

        <header class="mb-6">

            <h1 class="text-3xl font-bold text-gray-800">

                {{ $header }}

            </h1>

            <hr class="mt-2 border-gray-300">

        </header>

        @endif


        <div class="flex-1 overflow-auto">

            @yield('content')

        </div>


    </main>


    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>

</body>

</html>