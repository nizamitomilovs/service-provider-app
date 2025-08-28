<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Service Provider Directory') }}</title>

    <style>
        .container { max-width: 1200px; margin: 0 auto; padding: 0 1rem; }
        .pr-5 { padding-right: 1.25rem; }
        .font-bold { font-weight: 700; }
        .text-gray-900 { color: rgb(17 24 39); }
        .bg-white { background-color: rgb(255 255 255); }
        .shadow-sm { box-shadow: 0 1px 2px 0 rgb(0 0 0 / 0.05); }
        .border-gray-200 { border-color: rgb(229 231 235); }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('head')
</head>
<body class="bg-gray-50 antialiased">
    <nav class="bg-white shadow-sm border-b border-gray-200">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <a href="{{ url('/') }}" class="text-xl font-bold text-gray-900">
                        Service Directory
                    </a>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ url('/') }}" class="text-gray-700 hover:text-gray-900">Providers</a>
                </div>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>
</body>
</html>
