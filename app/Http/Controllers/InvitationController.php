<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Event;
use App\Models\Invitation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvitationController extends Controller
{

    public function antwoordenOrigineel(Event $event, Request $request) {
        $incomingFields = $request->validate([
            'antwoord' => 'required', 
            'koosnaam' => 'min:2'
        ]);
        $userId = auth()->guard()->id();
        $userInvitation = Invitation::where('event_id', $event->id)
        ->where('user_id', $userId)->first();

        if($userInvitation) {
            $userInvitation->going = $incomingFields['antwoord'];
            $userInvitation->save();
            return redirect()->back();
        } else if($userId) {
            dd('hoi');
            $invitationData = [
                'event_id' => $event->id, 
                'user_id' => $userId, 
                'going' =>  $incomingFields['antwoord']
            ];
        } else {
            dd('hoi');
            $invitationData = [
                'event_id' => $event->id, 
                'user_name' => $incomingFields['koosnaam'],
                'going' =>  $incomingFields['antwoord'],
            ];
        }

        
        Invitation::create($invitationData);

        return redirect()->back();
 
    }

    public function antwoorden(Event $event, Request $request) {
        $inputs = $request->validate([
            'user_name' => 'nullable|min:2', 
            'going' => 'required', 
            'user_id' => 'nullable'
        ]);

        $inputs['event_id'] = $event->id;

        $user = Auth::user();

        $creator = User::where('id', $event->user_id)->first();
        if ($user === $creator) {
            dd("please vertel me hoe je tot deze pagina bent geraakt! gustave.curtil@tutanota.com");
        }

        if ($user) {
            $invitation = Invitation::where('user_event_id', $event->id)->where('invited_user_id', $user->id)->first();
            if ($invitation) {
                $invitation->invited_guest_name = $inputs['invited_guest_name'];
                $invitation->going = $inputs['going'] = filter_var($request->input('going'), FILTER_VALIDATE_BOOLEAN);
                $invitation->save();
            } else {
                $inputs['invited_user_id'] = $user->id;
                $inputs['going'] = filter_var($request->input('going'), FILTER_VALIDATE_BOOLEAN);

                Invitation::create($inputs); 
            }

            return redirect('/' . $event->invitation_slug);
        }

        //check of gekozen koosnaam niet al een bestaande gebruiker is
        $existingUser = User::where('name', $inputs['user_name'])->first();
        if ($existingUser) {
            dd("'" . $existingUser->name . "' is al een gebruikersnaam. Zet er een cijferke bij als ge die naam per se wilt gebruiken!");
        }


        $invitation = Invitation::where('event_id', $event->id)->where('user_name', $inputs['user_name'])->first();
        $inputs['going'] = filter_var($request->input('going'), FILTER_VALIDATE_BOOLEAN);
        if ($invitation) {
            $invitation->going = $inputs['going'];
            $invitation->save();
        } else {
            Invitation::create($inputs); 
        }


        return redirect('/uitnodiging/' . $event->invitation_slug);
    }


    // public function inviteUser(Event $event, User $user) 
    // {
    //     $userId = auth()->guard()->id();
    //     $eventSave = Save::where('user_id', $userId)
    //     ->where('event_id', $event->id)->first();

    //     if ($eventSave) {
    //         if ($request->input('opslaan') === "opslaan") {
    //             $eventSave->saved = true;
    //         } else {
    //             $eventSave->saved = false;
    //         }
    //         $eventSave->save();
    //     } else {
    //         $eventSave = Save::create([
    //             'user_id' => $userId,
    //             'event_id' => $event->id,
    //             'saved' => true  // Assuming you're passing the Event model
    //         ]);
    //     }

    //     if($eventSave->saved) {
    //         // return redirect()->back();  
    //         return redirect('/overzicht');
    //     }
    //     return redirect('/');
    // }
}
