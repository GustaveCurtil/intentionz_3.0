@extends('_layouts.head')

@section('title', '')

@section('main')
    <h2>open evenementen</h2>
    @if ($laatsteEvent)
    <p><small>laatste update: {{$laatsteEvent->updated_at->format('H:i d/m/Y')}}</small></p>
    @endif
    <section>
        @if ($events->isEmpty())
        <p>geen evenementen</p>
        @else
            @foreach ($events as $event)

            <p><a href="/evenement/{{ $event->id }}">{{ $event->datum->format('d/m/Y') }} {{ $event->tijd->format('H:i') }} | <strong>{{ $event->titel }}</strong> - {{ $event->locatie_naam }}</a> 
                @if ($event->saves->contains('saved', true))
                ☼
                @endif
            </p>
            @endforeach
        @endif
    </section>

@endsection