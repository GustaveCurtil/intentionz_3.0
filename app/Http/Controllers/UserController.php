<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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

        if (auth()->guard()->attempt($username)) {
            $request->session()->regenerate();
            return redirect('/');
        } 

        $useremail = [
            'email' => $incomingFields['naam'], 
            'password' => $incomingFields['wachtwoord']
        ];

        if (auth()->guard()->attempt($useremail)) {
            $request->session()->regenerate();
            return redirect('/');
        } 

        return redirect('/login');
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
}
