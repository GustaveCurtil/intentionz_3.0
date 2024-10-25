<?php

namespace App\Http\Controllers;

use App\Models\Save;
use App\Models\User;
use App\Models\Event;
use App\Models\Invitation;
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
        //zijt ge wel ingelogd?
        $userId = auth()->guard()->id();
        $user = User::where('id', auth()->guard()->id())->first();

        //gaat het om een privé evenement?
        if ($event->publiek) {
            if ($user) {
                //is het publiek event opgeslagen of niet?...
                $savedEvent = Save::where('user_id', $userId)
                ->where('event_id', $event->id)->first();
                $event->saved = $savedEvent && $savedEvent->saved;
            }
            return view('evenement_publiek', ['event' => $event, 'user' => $user]);
        } else {

            if ($user) {

            } else {
                dd('op link gedruk zonder slug, zonder ingelogd te zijn. hmm kan dit? Please stuur gustave.curtil@tutanota.com als je op deze pagina bent geraakt. Pagecontroller event()');
            }
        }

        //wie komt er en wie niet?
        return view('evenement_prive', ['event' => $event, 'user' => $user]);
    }

    public function uitnodiging($slug)
    {
        //zijt ge wel ingelogd?
        $userId = auth()->guard()->id();
        $user = User::where('id', auth()->guard()->id())->first();

        //welk event?
        $event = Event::where('invitation_slug', $slug)->first();

        //ben ik ingelogd?
        if ($user) {

            //voeg mij toe aan invitation lijst met user_id
            //redirect mij naar event?

        } else {

            //voeg mij toe aan invitation lijst met user_name

        }

        //wie komt er en wie niet?
        return view('evenement_prive', ['event' => $event, 'user' => $user]);
    }

    // public function uitnodiging($slug)
    // {
    //     $user = User::where('id', auth()->guard()->id())->first();
    //     $event = Event::where('invitation_slug', $slug)->firstOrFail();
    //     $invitations = Invitation::where('event_id', $event->id)->get();

    //     // Optionally, assign filtered invitations back to the event object if needed
    //     $event->setRelation('invitations', $invitations);

    //     return view('uitnodiging', ['event' => $event, 'user' => $user]);

    // }

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
        $eventsMy = Event::where('user_id', $userId)
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

