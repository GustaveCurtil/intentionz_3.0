@extends('_layouts.head')

@section('main')

    <h2>inloggen</h2>
    <form action="login" method="post">
        @csrf
        <input type="text" name="naam" id="naam" placeholder="naam of e-mail">
        <input type="password" name="wachtwoord" id="wachtwoord" placeholder="wachtwoord">
        <input type="submit" value="inloggen">
    </form>

@endsection