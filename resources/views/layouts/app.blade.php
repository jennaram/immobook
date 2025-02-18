<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Immobook</title>
    @vite(['resources/css/app.css', 'resources/js/app.js']) </head>
<body class="bg-gray-100">
    <header class="bg-white p-4">
        <nav class="container mx-auto flex justify-between items-center">
            <a href="/" class="text-2xl font-bold">Immobook</a>
            <div>
                </div>
        </nav>
    </header>

    <main class="container mx-auto py-8">
        @yield('content')
    </main>

    <footer class="bg-gray-200 p-4 text-center">
        <p>&copy; 2024 Immobook</p>
    </footer>
</body>
</html>