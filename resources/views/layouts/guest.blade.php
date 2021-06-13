<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" href="logo.png" sizes="192x192">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Norican&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
    <style>
        .rtl {
            direction: rtl;
        }

        .ltr {
            direction: ltr;
        }
    </style>
</head>

<body class="font-sans antialiased {{ isset($rtl) ? 'rtl' : 'ltr'}}" dir="{{ isset($rtl) ? 'rtl' : 'ltr'}}">
    <div class="font-sans text-gray-900 antialiased">
        {{ $slot }}
    </div>
    <div class="text-center bg-gray-100 py-4">
        <span>
            <a href="setlang/en" class=" mx-2 text-blue-700">English</a>-
            <a href="setlang/ar" class=" mx-2 text-blue-700">العربيه</a>

        </span>
    </div>
</body>

</html>
