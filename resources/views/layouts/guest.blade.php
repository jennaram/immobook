<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Immobook</title>  {{-- Titre plus pertinent --}}

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-900 antialiased bg-gray-100"> {{-- Ajout de bg-gray-100 pour uniformité --}}

    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0"> {{-- Suppression de la classe bg-gray-100 ici --}}
        <div class="mb-8"> {{-- Ajout de marge en bas pour espacer le logo du contenu --}}
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-indigo-500" /> {{-- Changement de couleur du logo --}}
            </a>
        </div>

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            {{ $slot }}
        </div>

        {{-- Ajout d'un footer simple --}}
        <footer class="mt-8 text-center text-gray-500">
            &copy; {{ date('Y') }} Immobook
        </footer>
    </div>

</body>
</html>