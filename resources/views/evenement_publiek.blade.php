@extends('_layouts.head')

@section('head')
<link rel="stylesheet" href="{{ asset('css/poster.css') }}">
@endsection

@section('main')

    <section>
        <h2>{{ $event->titel }} (publiek)</h2>    
        <figure>
            <img src="/storage/{{ $event->foto_pad }}" alt="poster voor het evenement:{{$event->titel}}" style="left: {{$event->horizontaal}}%; top: {{$event->verticaal}}%; transform: translate(-50%, -50%) scale({{ $event->zoom }}%);">
        </figure>
        <p>{{ $event->datum }} om {{ $event->tijd }}</p>
        <p>{{ $event->beschrijving }}</p>
    </section>
    
    @auth
    <section>
        <form action="/evenement/{{ $event->id }}/opslaan" method="POST">
            @csrf
            @if ($event->saved)
            <input type="submit" name="opslaan" value="niet meer opslaan">           
            @else
            <input type="submit" name="opslaan" value="opslaan">           
            @endif
        </form>
    </section>
    @endauth

@endsection