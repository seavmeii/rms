<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">

    <!-- Header -->
    <header class="bg-white shadow p-4">
        <h1 class="text-2xl font-bold text-gray-800">@yield('header', 'Profile')</h1>
    </header>

    <!-- Content -->
    <main class="flex-1 p-6">
        @yield('content')
    </main>

</body>
</html>