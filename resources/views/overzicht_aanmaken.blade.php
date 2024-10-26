@extends('_layouts.head')

@section('title', 'aanmaken')

@section('head')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<script src="{{ asset('js/editor.js') }}" defer></script>
@endsection

@section('main')
    <h2>evenement aanmaken</h2>
    <figure id="poster"><img></img></figure>
    <form action="create-event" method="post" enctype="multipart/form-data">
        @csrf
        <fieldset>
            <legend>poster</legend>
            <input type="range" name="zoom" id="zoom" min="75" max="400" value="100" list="zoom-punt">
            <datalist id="zoom-punt">
                <option value="100"></option>
            </datalist>

            <input type="range" name="horizontaal" id="horizontaal" min="0" max="100" value="50" list="horizontaal-punt">
            <datalist id="horizontaal-punt">
                <option value="50"></option>
            </datalist>

            <input type="range" name="verticaal" id="verticaal" min="0" max="100" value="50" list="verticaal-punt">
            <datalist id="verticaal-punt">
                <option value="50"></option>
            </datalist>

            <input type="file" name="foto" id="foto" accept=".jpg, .jpeg, .png">
            <input type="color" name="kleur" id="kleur" value="#FFFFFF">
        </fieldset>
        <fieldset>
            <legend>basisinfo*</legend>
            <input type="text" name="titel" id="titel" maxlength="30" required placeholder="titel" @if ($errors->any()) value="{{ old('titel') }}" @endif>
            <input type="text" name="locatie_naam" id="locatie_naam" maxlength="50" required placeholder="naam van de locatie" @if ($errors->any()) value="{{ old('locatie_naam') }}" @endif>
            <input type="date" name="datum" id="datum" required @if ($errors->any()) value="{{ old('datum') }}" @endif>
            <input type="time" name="tijd" id="tijd" required @if ($errors->any()) value="{{ old('tijd') }}" @endif>          
        </fieldset>
        <fieldset>
            <legend>bien om erbij te hebben</legend>
            <textarea name="beschrijving" id="beschrijving" maxlength="500" placeholder="beschrijving">@if ($errors->any()) {{ old('beschrijving') }} @endif</textarea>
            <input type="url" name='locatie_url' id='locatie-url' placeholder="link naar maps" @if ($errors->any()) value="{{ old('locatie_url') }}" @endif>
        </fieldset>
        <fieldset>
            <legend>openbaar evenement</legend>
            <input type="checkbox" name="publiek" id="publiek" value="1" @if ($errors->any()) {{ old('publiek') ? 'checked' : '' }} @endif><label for="publiek">openbaar evenement</label><br>
            <input type="url" name='evenement_url' id='evenement-url' placeholder="link van evenement" @if ($errors->any()) value="{{ old('evenement_url') }}" @endif>
        </fieldset>

        <input type="submit" value="concept opslaan">
    </form>

    @if ($errors->any())
    <details><summary>foutmelding ({{ $errors->count() }})</summary>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </details>
    @endif

@endsection