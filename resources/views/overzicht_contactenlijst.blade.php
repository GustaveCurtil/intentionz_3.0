@extends('_layouts.head')

@section('main')
    <h2>bestaande gebruikers</h2>
    <p>(tijdelijke optie voor debugg'en enzo)</p>
    <section>
        @if ($users->isEmpty())
        <p>er zijn momenteel geen users.</p>
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
        <p>geen contacten, maar da's totaal niet nodig ook ni eigenlijk.</p>
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

@endsection