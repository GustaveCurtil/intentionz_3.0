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
        <nav>@include('_partials.navigation')</nav>
    </header>  

    <main>
        @yield('main')
    </main>
    <br>
    <hr>
    <footer>
        <p>
        @auth
        je bent ingelogd als <strong>{{ auth()->user()->name }}</strong> ☺      
        @endauth
        <a href="/over">over</a> ☺ feedback naar <u onclick="copyMail('gustave.curtil@tutanota.com')">gustave.curtil@tutanota.com</u> ☺ aantal broeders en zusters met een login: <strong>{{ $totalUsers }}/100</strong>
        <meter min="0" max="100" value="{{ $totalUsers }}">{{ $totalUsers }}</meter></p>
    </footer>
    <script>
        function copyMail(link) {
            navigator.clipboard.writeText(link).then(() => {
                alert("♥ mail is gekopieerd ❀");
            }).catch(err => {
                console.error("Failed to copy: ", err);
                alert("Failed to copy the link.");
            });
        }
    </script>
</body>