<a href="{{ route('publiek') }}">evenementen</a>
@guest
    <a href="{{ route('login') }}">inloggen</a>
    <a href="{{ route('registreer') }}">registreren</a>
@endguest
@auth
<a href="{{ route('overzicht') }}">jouw overzicht</a>
<a href="{{ route('aanmaken') }}">aanmaken</a>
<a href="{{ route('contactenlijst') }}">contactenlijst</a>   
<a href="{{ route('instellingen') }}">instellingen</a> 
@endauth
