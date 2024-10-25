@extends('_layouts.head')

@section('main')

    <h2>evenementen</h2>
    <section>
        @if ($events->isEmpty())
        <p>Er zijn momenteel geen publieke evenementen.</p>
        @else
        @foreach ($events as $event)
            <a href="/evenement/{{ $event->id }}">{{ $event->titel }} - {{ $event->datum }} om {{ $event->tijd }} | {{ $event->user->name }}</a><br>
        @endforeach
        @endif
    </section>

@endsection