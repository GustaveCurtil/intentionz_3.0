@extends('_layouts.head')

@section('title', 'inloggen')

@section('head')
<script src="{{ asset('js/datavershroemper.js') }}" defer></script>
@endsection

@section('main')

    <h2>inloggen</h2>
    <form action="login" method="post" autocomplete>
        @csrf
        <input type="text" name="naam" id="naam" placeholder="naam of e-mail" value="{{ old('naam') }}">
        <input type="password" name="wachtwoord" id="wachtwoord" placeholder="wachtwoord" required>
        <input type="hidden" name="localEvents" id="localEvents">
        <input type="hidden" name="localKoosnaam" id="localKoosnaam">
        <input type="submit" value="yihaa">
    </form>

    @if(session('error'))
    {{ old('naam') }}
    {{ old('name') }}
        <p>{{ session('error') }}</p>
    @endif

@endsection

