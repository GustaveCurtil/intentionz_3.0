@extends('_layouts.head')

@section('head')
<link rel="stylesheet" href="{{ asset('css/poster.css') }}">
{{-- <script src="storage.js" defer></script> --}}
@endsection

@section('main')
    <section>
        <h2>{{ $event->titel }} (privé)</h2>    
        <figure>
            <img src="/storage/{{ $event->foto_pad }}" alt="" height="400px">
        </figure>
        <p>{{ $event->datum }} om {{ $event->tijd }}</p>
        <p>georganiseerd door {{ $event->user->name }}</p>
        <p>locatie: {{ $event->locatie_naam }}</p>
        <p>beschrijving: {{ $event->beschrijving }}</p>
    </section>

    <section>
        <p><u>Gaan</u> ❀
            @if($event->goingGuests->isNotEmpty())
            @foreach ($event->goingGuests as $guest)
                @if($guest->user_name)
                    {{$guest->user_name}} ❀ 
                @endif
                @if($guest->user_id)
                    {{$guest->user->name}} ❀ 
                @endif
            @endforeach
        @endif
        </p>
        <p><u>Gaan niet</u> ♥ 
        @if($event->notGoingGuests->isNotEmpty())
        @foreach ($event->notGoingGuests as $guest)
            @if($guest->user_name)
                {{$guest->user_name}} ♥ 
            @endif
            @if($guest->user_id)
                {{$guest->user->name}} ♥ 
            @endif
        @endforeach
        @endif
        </p>
    </section>



    @if (isset($user) && $event->user_id === $user->id)
        <button>aanpassen</button>
        <button>uitnodigen</button>
        <p>http://127.0.0.1:8000/uitnodiging/{{$event->invitation_slug}}</p>
    @else
  


    <form action="/antwoorden/{{ $event->id }}" method="post">
        @csrf
        @if (!isset($user))
        <input type="text" name="user_name" id="user_name" placeholder="Wie bent ge?">
        @endif
        <button name="going" value="1">gaan</button>
        <button name="going" value="0">niet gaan</button>
    </form>

    @endif


@endsection

@guest
<script>
    document.addEventListener("DOMContentLoaded", () => {
    // Check if 'events' exists in localStorage
    let evenementen;
    let naamVeld = document.querySelector("input#user_name");
    let naam;

    if (localStorage.getItem('koosnaam')) {
        naamVeld.value = localStorage.getItem('koosnaam');
    }

    naamVeld.addEventListener("input", (e) => {
        naam = naamVeld.value;
        localStorage.setItem('koosnaam', naam);
    })



    // // If 'events' is not present in localStorage, initialize it as an empty array
    // if (!localStorage.getItem('events')) {
    //     evenementen = []; // Initialize as an empty array
    // } else {
    //     evenementen = JSON.parse(localStorage.getItem('events'));
    // }

    // if (!evenementen.includes({{ $event->id }})) {
    //     // Add the new event ID to the array
    //     evenementen.push({{ $event->id }});

    //     // Store the updated array back to localStorage
    //     localStorage.setItem('events', JSON.stringify(evenementen));
    // }

    // console.log(evenementen);
})
</script>
@endguest