<?php

namespace App\Http\Controllers;

use App\Models\Save;
use App\Models\User;
use App\Models\Event;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function publiek()
    {
        $events = Event::where('publiek', true)
        ->with('user')
        ->orderBy('datum', 'asc')  // Ascending order for date
        ->orderBy('tijd', 'asc')   // Ascending order for time
        ->get();

        return view('publiek_', compact('events'));
    }

    public function event(Event $event)
    {
        $userId = auth()->guard()->id();
        $savedEvent = Save::where('user_id', $userId)
        ->where('event_id', $event->id)->first();

        $event->saved = $savedEvent && $savedEvent->saved;

        return view('evenement', ['event' => $event]);
    }

    public function login()
    {
        return view('publiek_login');
    }

    public function registreer()
    {
        return view('publiek_registreer');
    }

    public function overzicht()
    {
        $userId = auth()->guard()->id();

        //Door mij georganiseerde evenementen
        $eventsMy = Event::where('publiek', false)
        ->where('user_id', $userId)
        ->with('user')
        ->get();

        //Opgeslagen evenementen
        $saves = Save::where('user_id', $userId)->where('saved', true)->get();
        $eventsSaved = $saves->pluck('event');

        //VERZAMELEN VAN EVENEMENTEN
        $eventsAll = $eventsMy->merge($eventsSaved);
        $events = $eventsAll->sortBy([
            ['datum', 'asc'],
            ['tijd', 'asc'], 
        ]);

        return view('overzicht_', compact('events'));
    }

    public function contactenlijst()
    {
        $follower = User::where('id', auth()->guard()->id())->first();
        // Get the IDs of users that the authenticated user is following
        $followingIds = $follower->following->pluck('id'); // Get the IDs of following users

        // Retrieve all users except the ones that the authenticated user is following
        $users = User::whereNotIn('id', $followingIds)
        // ->where('id', '!=', $follower->id) // Exclude the authenticated user
        ->get();

        $contacts = $follower->following;
        return view('overzicht_contactenlijst', compact('users', 'contacts', 'follower'));
    }

    public function instellingen()
    {
        return view('overzicht_instellingen');
    }

    public function aanmaken()
    {
        $user = User::where('id', auth()->guard()->id())->first();
        return view('overzicht_aanmaken', compact('user'));
    }

    public function aanpassen()
    {
        return view('overzicht_aanpassen');
    }
}

