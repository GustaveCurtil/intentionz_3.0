<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Event;
use App\Models\Invitation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvitationController extends Controller
{

    public function antwoorden(Event $event, Request $request) {
        $inputs = $request->validate([
            'user_id' => 'nullable',
            'user_name' => 'nullable|min:2', 
            'going' => 'required', 
            'vorige_naam' => 'nullable'
        ]);

        $inputs['event_id'] = $event->id;

        $user = Auth::user();

        $creator = User::where('id', $event->user_id)->first();
        if ($user === $creator) {
            dd("please vertel me hoe je tot deze pagina bent geraakt! gustave.curtil@tutanota.com");
        }

        if ($user) {
            $invitation = Invitation::where('event_id', $event->id)->where('user_id', $user->id)->first();
            if ($invitation) {
                $invitation->going = $inputs['going'];
                $invitation->save();
            } else {
                dd('plies vertel me hoe je op deze pagina bent geraakt: gustave.curtil@tutanota.com. REF: antwoorden().moetuitnodigingnogopslaan?');
            }

            return redirect()->back();
        }

        //check of gekozen koosnaam niet al een bestaande gebruiker is
        $existingUser = User::where('name', $inputs['user_name'])->first();
        if ($existingUser) {
            dd("'" . $existingUser->name . "' is al een gebruikersnaam. Zet er een cijferke bij als ge die naam per se wilt gebruiken!");
        }


        $invitationSame = Invitation::where('event_id', $event->id)->where('user_name', $inputs['user_name'])->first();
        $invitationChange = Invitation::where('event_id', $event->id)->where('user_name', $inputs['vorige_naam'])->first();
        $invitation = $invitationSame ?: $invitationChange;
        if ($invitation) {
            $invitation->going = $inputs['going'];
            $invitation->user_name = $inputs['user_name'];
            $invitation->save();
        } else {

            Invitation::create([
                'user_name' => $inputs['user_name'],
                'event_id'  => $event->id,
                'going'     => $inputs['going'],
            ]); 
        }
        return redirect()->back()->withInput();
    }
    

}
