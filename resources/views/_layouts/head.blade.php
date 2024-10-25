<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>♥</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @yield('head')
</head>
<body>
    <header>
        {{-- <h1>FORM follows CSS follow SCREEN follows HTML follows PHP follows FUNCTION ♥</h1> --}}
        <nav>@include('_partials.navigation')</nav>
    </header>
    <main>
        @yield('main')
    </main>
    <br>
    <footer>
    @auth
    <p>je bent ingelogd als {{ auth()->user()->name }}</p>      
    @endauth
    <p>alle feedback welkom → gustave.curtil@tutanota.com</p>
    </footer>
</body>