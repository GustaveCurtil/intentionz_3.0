<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Event;
use App\Models\Invitation;
use Illuminate\Http\Request;
use App\Http\Controllers\InvitationController;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $incomingFields = $request->validate([
            'naam' => ['required', 'min:2', 'max:14','unique:users,name'],
            'wachtwoord' => ['required', 'min:2', 'max:100'], 
            'wachtwoord2' => ['required', 'same:wachtwoord'], 
            'email' => ['nullable', 'email','unique:users,email']
        ], 
        [
            'naam.unique' => '":input" bestaat al.',
            'email.unique' => '":input" is al geregistreerd.'
        ]);


        $incomingFields['wachtwoord'] = bcrypt($incomingFields['wachtwoord']);

        $userData = [
            'name' => $incomingFields['naam'],           // Assuming you save it as 'name'
            'password' => $incomingFields['wachtwoord'], // Assuming 'password' in DB
            'email' => $incomingFields['email'],         // 'email' is fine as it is
        ];

        $user = User::create($userData);

        auth()->guard()->login($user);

        $inviteIds = json_decode($request->input('localEvents'));
        $koosnaam = $request->localKoosnaam;
        if ($inviteIds) {
            foreach ($inviteIds as $inviteId) {
                $this->checkForInvitation($inviteId, $koosnaam);   
            }
            return ('/overzicht');
        }

        return redirect('/');
    }



    public function login(Request $request)
    {
        $incomingFields = $request->validate([
            'naam' => ['required'],
            'wachtwoord' => ['required']
        ]);

        $username = [
            'name' => $incomingFields['naam'], 
            'password' => $incomingFields['wachtwoord'], 
        ];

        $useremail = [
            'email' => $incomingFields['naam'], 
            'password' => $incomingFields['wachtwoord']
        ];

        //proberen inloggen
        if (auth()->guard()->attempt($username) || auth()->guard()->attempt($useremail)) {
            $request->session()->regenerate();

            //Invites die nog in localstorage staan toevoegen aan de collectie
            $inviteIds = json_decode($request->input('localEvents'));
            $koosnaam = json_decode($request->input('localKoosnaam'));
            if ($inviteIds) {
                foreach ($inviteIds as $inviteId) {
                    $this->checkForInvitation($inviteId, $koosnaam);   
                }
            }

            return redirect('/');
        } 

        //errorhandling indien niet kunnen inloggen
        $tryName = User::where('name', $incomingFields['naam'])->first();
        $tryEmail = User::where('email', $incomingFields['naam'])->first();
        if($tryName || $tryEmail) {
            session()->flash('error', 'Foute wachtwoord');
        } else {
            session()->flash('error', $incomingFields['naam'] . ' is geen bestaande gebruiker');
        }
        return redirect()->back();
    }

    public function logout()
    {
        auth()->guard()->logout();
        return redirect('/');
    }

    public function followUser(User $user)
    {
        $follower = User::where('id', auth()->guard()->id())->first();

        if (!$follower->isFollowing($user)) {
            $follower->follow($user);
        } else {
        }

        return redirect()->back();
    }

    public function unfollowUser(User $user)
    {
        $follower = User::where('id', auth()->guard()->id())->first();

        if ($follower->isFollowing($user)) {
            $follower->unfollow($user);
        } else {
        }

        return redirect()->back();
    }

    
    public function checkForInvitation($eventId, $koosnaam) {
        $userId = auth()->guard()->id();
        $invitation = null;
        $event = Event::where('id', $eventId)->first();
        if ($event) {
            if ($koosnaam) {
                $invitation = Invitation::where('event_id', $eventId)->where('user_name', $koosnaam)->first(); 
            }
            if ($invitation) {
                $invitation->user_id = $userId;
                $invitation->user_name= null;
                $invitation->save();
            } else {
                $inputs['event_id'] = $eventId;
                $inputs['user_id'] = $userId;
    
                Invitation::create($inputs);
            }
        }
    }
}
