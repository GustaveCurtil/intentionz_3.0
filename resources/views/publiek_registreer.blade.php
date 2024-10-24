@extends('_layouts.head')

@section('title', 'registreer')

<body>
    <h2>registreer</h2>
    <img src="media/fbisfree.png" alt="facebook ays: it's free and always will be">
    @if ($errors->any())
    <p>FOUTMELDING:</p>
    <p>Naam (min 2, max 14) en 2 overeenkomende wachtwoordvelden (min 3, max 100) zijn vereist.</p>
    @endif
    @error('naam')
    <p>{{ $message }}</p>
    @enderror
    @error('email')
    <p>{{ $message }}</p>
    @enderror
    <form action="register" method="post">
        @csrf
        <input type="text" name="naam" id="naam" placeholder="online naam*" @if ($errors->any()) value="{{ old('naam') }}" @endif>
        <input type="password" name="wachtwoord" id="wachtwoord" placeholder="wachtwoord*">
        <input type="password" name="wachtwoord2" id="wachtwoord2" placeholder="wachtwoord herhalen*">
        <input type="email" name="email" id="email" placeholder="e-mail (optioneel)" @if ($errors->any()) value="{{ old('email') }}" @endif>
        <input type="submit" value="yihaa">
    </form>
    @include('_partials.navigation')
</body>
</html>