@extends('_layouts.head')

@section('head')
    <meta name="description" content="instellingen">
    <link rel="stylesheet" href="{{ asset('css/editor.css') }}">
@endsection

@section('main')
    <h2>instellingen</h2>
    <form action="edit-password" method="post">
        @csrf
        <input type="password" name="wachtwoord-oud" id="wachtwoord-oud" placeholder="oud wachtwoord">
        <input type="password" name="wachtwoord-nieuw" id="wachtwoord-nieuw" placeholder="nieuw wachtwoord">
        <input type="password" name="wachtwoord-herhaal" id="wachtwoord-herhaal" placeholder="herhaal wachtwoord">
        <input type="submit" value="wijzig wachtwoord">
    </form>
    @if (false)
    <form action="edit-user" method="post">
        @csrf
        <input type="email" name="email" id="email">
        <input type="email" name="email-herhaal" id="email-herhaal">
    
        <input type="submit" value="opslaan">
    </form>
    @else
    <form action="edit-user" method="post">
        @csrf
        <input type="radio" id="nooit" name="notificaties" value="nooit">
        <label for="nooit">ik wil geen notificatiemails</label><br>
        <input type="radio" id="dagelijks" name="notificaties" value="dagelijks">
        <label for="dagelijks">ik wil elke update (maximum 1 per dag wel)</label><br>
        <input type="radio" id="wekelijks" name="notificaties" value="wekelijks">
        <label for="wekelijks">stuur wekelijkse updates</label><br>
        <input type="radio" id="maandelijks" name="notificaties" value="maandelijks">
        <label for="maandelijks">stuur maandelijkse updates</label>
        <input type="submit" value="opslaan">
    </form>
    <form action="edit-user" method="post">
        @csrf
        <input type="checkbox" name="vriendenmail" id="vriendenmail"><label for="vriendenmail">ontvang berichten van organisator</label>
        <input type="checkbox" name="verwijder-account" id="verwijder-account"><label for="verwijder-account">ik ben zeker</label>
        <input type="submit" value="make it happen please!">
    </form>
    @endif
    <form action="/logout" method="post">
        @csrf
        <button>afmelden</button>
    </form>
    <form action="delete-user" method="post">
        @csrf
        <input type="checkbox" name="verwijder-account" id="verwijder-account"><label for="verwijder-account">verwijder account</label>
        <input type="checkbox" name="verwijder-account" id="verwijder-account"><label for="verwijder-account">ik ben zeker</label>
        <input type="submit" value="make it happen please!">
    </form>

@endsection
