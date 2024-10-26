@extends('_layouts.head')

@section('title', 'registreren')

@section('head')
<script src="{{ asset('js/datavershroemper.js') }}" defer></script>
@endsection

@section('main')
    <figure id='registreren'>
        <img src="media/fbisfree.png" alt="facebook says: it's free and always will be">
    </figure>
    <h2>registreren</h2>
    <form action="register" method="post">
        @csrf
        <input type="text" name="naam" id="naam" placeholder="online naam*" @if ($errors->any()) value="{{ old('naam') }}" @endif>
        <input type="password" name="wachtwoord" id="wachtwoord" placeholder="wachtwoord*">
        <input type="password" name="wachtwoord2" id="wachtwoord2" placeholder="wachtwoord herhalen*">
        <input type="email" name="email" id="email" placeholder="e-mail (optioneel)" @if ($errors->any()) value="{{ old('email') }}" @endif>
        <input type="hidden" name="localEvents" id="localEvents">
        <input type="hidden" name="localKoosnaam" id="localKoosnaam">
        <input type="submit" value="yihaa">
    </form>
    <br>

    @if ($errors->any())
    <details><summary>foutmelding ({{ $errors->count() + 1 }})</summary>
        <ul>
            @error('naam')
            <li>{{ $message }}</li>
            @enderror
            @error('email')
            <li>{{ $message }}</li>
            @enderror
            <li>Naam (min 2, max 14) en 2 overeenkomende wachtwoordvelden (min 3, max 100) zijn vereist.</li>
        </ul>
    </details>
    @endif

@endsection