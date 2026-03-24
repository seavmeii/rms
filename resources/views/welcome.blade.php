<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Flower Restaurant</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #111;
            color: white;
        }

        .hero {
            background: linear-gradient(rgba(0,0,0,0.7), rgba(80,30,10,0.6)),
                        url('/images/restaurant.jpg');
            background-size: cover;
            background-position: center;
        }

        .title-font {
            font-family: 'Playfair Display', serif;
        }

        .card {
            background: rgba(255,255,255,0.05);
            backdrop-filter: blur(6px);
            border-radius: 16px;
            padding: 20px;
            transition: 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .btn-main {
            background: #e63946;
        }

        .btn-main:hover {
            background: #c1121f;
        }
    </style>
</head>

<body>

<!-- Navbar -->
<nav class="flex justify-between items-center px-8 py-5">
    <h1 class="text-2xl font-bold">🌸 Flower Restaurant</h1>

    <div class="flex gap-4">
        <a href="{{ route('login') }}" class="px-5 py-2 border rounded-lg hover:bg-white hover:text-black transition">
            Login
        </a>

        @if(Route::has('register'))
        <a href="{{ route('register') }}" class="px-5 py-2 bg-red-500 rounded-lg hover:bg-red-600">
            Register
        </a>
        @endif
    </div>
</nav>

<!-- Hero -->
<section class="hero text-center py-24 px-6">
    <h1 class="title-font text-5xl md:text-6xl font-bold mb-4">
        Delicious Food, Delivered Fast 🍔
    </h1>

    <p class="text-gray-200 max-w-xl mx-auto mb-6">
        Discover tasty meals, fresh ingredients, and the best dining experience—all in one place.
    </p>

    <a href="{{ route('login') }}" class="btn-main px-8 py-3 rounded-lg font-semibold shadow-lg">
        Login to Order Now
    </a>
</section>

<!-- Featured Food -->
<section class="py-16 px-6 text-center">
    <h2 class="title-font text-3xl font-bold mb-10">🍽️ Popular Dishes</h2>

    <div class="grid md:grid-cols-3 gap-8 max-w-6xl mx-auto">

        <div class="card">
            <img src="/images/burger.jpg" class="rounded-lg mb-4 h-40 w-full object-cover">
            <h3 class="text-xl font-semibold">Beef Burger</h3>
            <p class="text-gray-300 text-sm">Juicy and perfectly cooked</p>
        </div>

        <div class="card">
            <img src="/images/fries.jpg" class="rounded-lg mb-4 h-40 w-full object-cover">
            <h3 class="text-xl font-semibold">French Fries</h3>
            <p class="text-gray-300 text-sm">Loaded with flavor</p>
        </div>

        <div class="card">
            <img src="/images/papayasalad.webp" class="rounded-lg mb-4 h-40 w-full object-cover">
            <h3 class="text-xl font-semibold">Fresh Papaya Salad</h3>
            <p class="text-gray-300 text-sm">Healthy and refreshing</p>
        </div>

    </div>
</section>

<!-- Why Choose Us -->
<section class="py-16 px-6 bg-black text-center">
    <h2 class="title-font text-3xl font-bold mb-10">⭐ Why Choose Us</h2>

    <div class="grid md:grid-cols-3 gap-8 max-w-5xl mx-auto">

        <div>
            <h3 class="text-xl font-semibold mb-2">🍴 Fresh Ingredients</h3>
            <p class="text-gray-400">We use only the best quality ingredients</p>
        </div>

        <div>
            <h3 class="text-xl font-semibold mb-2">⚡ Fast Service</h3>
            <p class="text-gray-400">Quick and reliable ordering system</p>
        </div>

        <div>
            <h3 class="text-xl font-semibold mb-2">💳 Easy Payment</h3>
            <p class="text-gray-400">Secure payment with ABA Payway</p>
        </div>

    </div>
</section>

<!-- Call to Action -->
<section class="py-20 text-center">
    <h2 class="title-font text-4xl font-bold mb-4">
        Ready to Order?
    </h2>

    <p class="text-gray-300 mb-6">
        Login now and enjoy your favorite meals 🍕
    </p>

    <a href="{{ route('login') }}" class="btn-main px-10 py-3 rounded-lg font-semibold">
        Login Now
    </a>
</section>

</body>
</html>