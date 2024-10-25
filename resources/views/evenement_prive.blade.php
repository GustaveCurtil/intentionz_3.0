@extends('_layouts.head')

@section('head')
<link rel="stylesheet" href="{{ asset('css/poster.css') }}">
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
        {{-- @foreach($event->invitations as $invitation)

        @if($invitation->user_name)
        {{ $invitation->user_name }} :  {{ $invitation->going }}<!-- Display the user's name -->
        @endif
        @if($invitation->user)
            {{ $invitation->user->name }} : {{ $invitation->going }} <!-- Display the user's name -->
        @endif
        
        @endforeach --}}

        {{-- <p>Gaan:</p> ❀
            @if($event->goingGuests)
            @foreach ($event->goingGuests as $guest)
                @if($guest->invited_guest_name)
                    {{$guest->invited_guest_name}} ❀ 
                @endif
            @endforeach
        @endif --}}

    </section>

    
    @if (isset($user))
        @if ($event->user_id === $user->id)
        
        <button>aanpassen</button>
        <button>uitnodigen</button>
        <p>http://127.0.0.1:8000/uitnodiging/{{$event->invitation_slug}}</p>
        @endif
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
    // Check if 'events' exists in localStorage
    let evenementen;
     

        // If 'events' is not present in localStorage, initialize it as an empty array
    // if (localStorage.getItem('naam')) {
    //     let naam = localStorage.getItem('naam');
        
    // } else {
    //     localStorage.setItem('events', );
    // }

    // If 'events' is not present in localStorage, initialize it as an empty array
    if (!localStorage.getItem('events')) {
        evenementen = []; // Initialize as an empty array
    } else {
        evenementen = JSON.parse(localStorage.getItem('events'));
    }

    if (!evenementen.includes({{ $event->id }})) {
        // Add the new event ID to the array
        evenementen.push({{ $event->id }});

        // Store the updated array back to localStorage
        localStorage.setItem('events', JSON.stringify(evenementen));
    }

    console.log(evenementen);
</script>
@endguest