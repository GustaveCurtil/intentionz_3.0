<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
    {{-- title should be unique on every page... --}}
    <title>intentionz_3.0 ♥ @yield('title')</title> 
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @yield('head')
</head>
<body>
    <header>
        <h1>intentionz_3.0</h1>
        <cite>FORM follows CSS follow DEVICE follows HTML follows PHP follows FUNCTION</cite></h2>
        <nav>@include('_partials.navigation')</nav>
    </header>
    <main>
        @yield('main')
    </main>
    <hr>
    <footer>
    @auth
    <p>je bent ingelogd als {{ auth()->user()->name }}</p>      
    @endauth
    <p>alle feedback welkom → gustave.curtil@tutanota.com</p>
    <p>aantal broeders en zusters met een login: {{ $totalUsers }}/100 <progress max="100" value="{{ $totalUsers }}">{{ $totalUsers }}/100</progress></p>
    </footer>
</body>