<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Flower Restaurant') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>


<body class="font-sans antialiased bg-gradient-to-br from-white-100 via-white-100 to-purple-100 min-h-screen flex items-center justify-center">


    <div class="w-full max-w-md">


        <!-- Logo + Title -->
        <div class="text-center mb-6">

            <a href="/" class="flex flex-col items-center">

               

                <h1 class="text-2xl font-bold text-gray-800 mt-2">
                    Flower Restaurant
                </h1>

                <p class="text-sm text-gray-500">
                    Welcome our lovely customer!
                </p>

            </a>

        </div>


        <!-- Auth Card -->
        <div class="bg-white shadow-xl rounded-xl px-8 py-6 border border-gray-100">

            {{ $slot }}

        </div>


        <!-- Footer -->
        <div class="text-center mt-6 text-sm text-gray-500">

            © {{ date('Y') }} Flower Restaurant

        </div>


    </div>

</body>

</html>