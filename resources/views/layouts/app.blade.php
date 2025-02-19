<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Immobook</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <link rel="icon" href="{{ asset('favicon.ico') }}">
</head>
<body class="bg-gray-100">
    <header class="bg-indigo-800 p-4 shadow">
    <nav class="container mx-auto flex justify-between items-center">
        <a href="/" class="text-2xl font-bold text-white">Immobook</a>
        <div class="flex space-x-4">
            <a href="{{ route('properties.index') }}" class="text-gray-100 hover:text-white">Propriétés</a>
            <a href="{{ route('bookings.index') }}" class="text-gray-100 hover:text-white">Réservations</a>
            {{-- ... autres liens ... --}}
        </div>
    </nav>
</header>

    <main class="container mx-auto py-8">
        @if (session('message'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('message') }}
            </div>
        @endif
        @yield('content')
    </main>

    <footer class="bg-gray-200 p-4 text-center">
        <p>&copy; 2024 Immobook</p>
    </footer>

    @livewireScripts
</body>
</html>