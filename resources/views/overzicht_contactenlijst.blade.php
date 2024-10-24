@extends('_layouts.head')

@section('title', 'overzicht')

<body>
    <h2>bestaande gebruikers</h2>
    <section>
        @if ($users->isEmpty())
        <p>Er zijn momenteel geen publieke evenementen.</p>
        @else
        @foreach ($users as $user)
        <form action="volg/{{$user->id}}" method="post">
            @csrf
            <li>{{$user->name}}
            @if ($user->id !== $follower->id)
            <button>toevoegen</button>
            @else
            (ik)
            @endif
            </li>
        </form>
        @endforeach
        @endif
    </section>
    <h2>contactenlijst</h2>
    <section>
        @if ($contacts->isEmpty())
        <p>Er zijn momenteel geen publieke evenementen.</p>
        @else
        @foreach ($contacts as $contact)
        <form action="ontvolg/{{$contact->id}}" method="post">
            @csrf
            <li>{{$contact->name}}
            <button>verwijderen</button>
            </li>
        </form>
        @endforeach
        @endif
    </section>
    @include('_partials.navigation')
</body>
</html>