@extends('_layouts.head')

@section('title', $event->titel)

@section('main')

    <section>  
        <figure id="poster">
            <img src="/storage/{{ $event->foto_pad }}" alt="poster voor het evenement:{{$event->titel}}" style="left: {{$event->horizontaal}}%; top: {{$event->verticaal}}%; transform: translate(-50%, -50%) scale({{ $event->zoom }}%);">
        </figure>
        <h2>{{ $event->titel }} <small>(openbaar)</small></h2>  
        <p>{{ $event->datum->format('l d F Y') }} om {{ $event->tijd->format('H:i') }}</p>
        <p>georganiseerd door {{ $event->user->name }}</p>
        <p>{!! nl2br(e($event->beschrijving)) !!}</p>
    </section>
    
    @auth

    @if (isset($user) && $event->user_id === $user->id)

    <a href="/evenement/{{ $event->id }}/editor">evenement aanpassen</a>
    
    @else

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
    @endif
    @endauth

@endsection