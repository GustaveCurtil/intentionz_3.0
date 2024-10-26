@extends('_layouts.head')

@section('title', $event->titel)

@section('main')

<section>  
    <figure id="poster">
        <img src="/storage/{{ $event->foto_pad }}" alt="poster voor het evenement:{{$event->titel}}" style="left: {{$event->horizontaal}}%; top: {{$event->verticaal}}%; transform: translate(-50%, -50%) scale({{ $event->zoom }}%);">
    </figure>
    <h2>{{ $event->titel }} <small>(openbaar)</small></h2>  
    <p>{{ $event->datum->format('d F Y') }} om {{ $event->tijd->format('H:i') }}</p>
    <p>georganiseerd door {{ $event->user->name }}</p>
    <p>{!! nl2br(e($event->beschrijving)) !!}</p>
</section>

    <section>
        <p><strong>Gaan</strong> ❀
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
        <p><strong>Gaan niet</strong> ♥ 
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

    <section>
        <p onclick="inviteLink('{{ url('/uitnodiging/' . $event->invitation_slug) }}')">{{ url('/uitnodiging/' . $event->invitation_slug) }}</p>
        <a>evenement aanpassen</a>
    </section>

    @else
 
    <section>
        <form action="/antwoorden/{{ $event->id }}" method="post">
            @csrf
            @if (!isset($user))
            <input type="text" name="user_name" id="user_name" placeholder="Wie bent ge?">
            @endif
            <button name="going" value="1">gaan</button>
            <button name="going" value="0">niet gaan</button>
        </form>
    </section>

    @endif

@endsection


@if (isset($user) && $event->user_id === $user->id)

<script>

function inviteLink(link) {
    navigator.clipboard.writeText(link).then(() => {
        alert("♥ uitnodigingslink is gekopieerd ❀");
    }).catch(err => {
        console.error("Failed to copy: ", err);
        alert("Failed to copy the link.");
    });
}
</script>

@endif

@guest
<script>
    document.addEventListener("DOMContentLoaded", () => {

        let evenementen;
        let naamVeld = document.querySelector("input#user_name");
        let naam;

        if (localStorage.getItem('koosnaam')) {
            naamVeld.value = localStorage.getItem('koosnaam');
        } else {
            localStorage.setItem('koosnaam', "")
        }

        naamVeld.addEventListener("input", (e) => {
            naam = naamVeld.value;
            localStorage.setItem('koosnaam', naam);
        })


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

    })
</script>
@endguest