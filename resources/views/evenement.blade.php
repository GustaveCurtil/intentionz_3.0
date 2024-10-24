@extends('_layouts.head')

@section('title', 'evenement')

@section('head')
<link rel="stylesheet" href="{{ asset('css/poster.css') }}">
@endsection

<body>
    <section>
    
        <figure>
            <img src="/storage/{{ $event->foto_pad }}" alt="" height="400px">
        </figure>
        <h2>{{ $event->titel }}</h2>
        <p>{{ $event->datum }} om {{ $event->tijd }}</p>
    @auth
    @if ($event->publiek)
    <form action="/evenement/{{ $event->id }}/opslaan" method="POST">
        @csrf
        @if ($event->saved)
        <input type="submit" name="opslaan" value="niet meer opslaan">           
        @else
        <input type="submit" name="opslaan" value="opslaan">           
        @endif
    </form>
    <p>Dit is een publiek evenement</p>
    @else
    <p>Dit is een privé evenement</p> 
    @endif
    @endauth
    </section>
    @include('_partials.navigation')
</body>
</html>