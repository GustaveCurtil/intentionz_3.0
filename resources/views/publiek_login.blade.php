@extends('_layouts.head')

@section('title', 'login')

<body>
    <h2>login</h2>
    <form action="login" method="post">
        @csrf
        <input type="text" name="naam" id="naam" placeholder="naam of e-mail">
        <input type="password" name="wachtwoord" id="wachtwoord" placeholder="wachtwoord">
        <input type="submit" value="inloggen">
    </form>
    @include('_partials.navigation')
</body>
</html>