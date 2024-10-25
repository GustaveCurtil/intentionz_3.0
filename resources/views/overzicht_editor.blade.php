@extends('_layouts.head')

@section('head')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<script src="{{ asset('js/editor.js') }}" defer></script>
@endsection

@section('main')
    <h2>evenement aanpassen</h2>
    <figure id="voorvertoning"><img src="/storage/{{ $event->foto_pad}}" style="left: {{$event->horizontaal}}%; top: {{$event->verticaal}}%; transform: translate(-50%, -50%) scale({{ $event->zoom }}%);"></img></figure>
    <form action="create-event" method="post" enctype="multipart/form-data">
        @csrf
        <input type="range" name="zoom" id="zoom" min="75" max="400" value="{{ $event->zoom}}">
        <input type="range" name="horizontaal" id="horizontaal" min="0" max="100" value="{{ $event->horizontaal}}">
        <input type="range" name="verticaal" id="verticaal" min="0" max="100" value="{{ $event->verticaal}}">
        <input type="file" name="foto" id="foto" accept=".jpg, .jpeg, .png">
        <br>
        <input type="text" name="titel" id="titel" maxlength="30" placeholder="titel" value="{{ $event->titel}}">
        <input type="text" name="locatie_naam" id="locatie_naam" maxlength="50" placeholder="naam van de locatie" value="{{ $event->locatie_naam}}">
        <input type="date" name="datum" id="datum" value="{{ $event->datum}}">
        <input type="time" name="tijd" id="tijd" value="{{ $event->tijd}}">
        <textarea name="beschrijving" id="beschrijving" maxlength="500" placeholder="beschrijving">{{ $event->foto_pad}}</textarea>
        <br>
        <input type="url" name='locatie_url' id='locatie-url' placeholder="link naar maps" value="{{ $event->foto_pad}}">
        <input type="checkbox" name="publiek" id="publiek" value="1" {{ $event->publiek ? 'checked' : '' }}><label for="publiek">publiek evenement</label>
        @if ($user->organisatie)
        <input type="url" name='evenement_url' id='evenement-url' placeholder="link van evenement" value="{{ $event->foto_pad}}">
        @endif

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