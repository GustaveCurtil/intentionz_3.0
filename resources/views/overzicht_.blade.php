@extends('_layouts.head')

@section('title', 'overzicht')

@section('main')
    <h2>jouw overzicht</h2>
    <section>
        @if ($events->isEmpty())
        <p>geen evenementen</p>
        @else
        @foreach ($events as $event)
        @if ($event->publiek)
        <p><a href="/evenement/{{ $event->id }}">{{ $event->datum->format('d/m/Y') }} {{ $event->tijd->format('H:i') }} | <strong>{{ $event->titel }}</strong> - {{ $event->user->name }}</a> ☼</p>
        @else
        <p><a href="/evenement/{{ $event->id }}">{{ $event->datum->format('d/m/Y') }} {{ $event->tijd->format('H:i') }} | <strong>{{ $event->titel }}</strong> - {{ $event->user->name }}</a> ⌂</p>
        @endif
        @endforeach
        @endif
    </section>

@endsection