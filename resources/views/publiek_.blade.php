@extends('_layouts.head')

@section('title', 'Publiek')

<body>
    <h1>FORM follows CSS follow SCREEN follows HTML follows PHP follows FUNCTION</h1>
    <h2>publiek</h2>
    <section>
        @if ($events->isEmpty())
        <p>Er zijn momenteel geen publieke evenementen.</p>
        @else
        @foreach ($events as $event)
            <a href="/evenement/{{ $event->id }}">{{ $event->titel }} - {{ $event->datum }} om {{ $event->tijd }} | {{ $event->user->name }}</a><br>
        @endforeach
        @endif
    </section>
    @include('_partials.navigation')
</body>
</html>