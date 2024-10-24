<br>
<a href="{{ route('publiek') }}">publiek</a>
@guest
    <a href="{{ route('login') }}">inloggen</a>
    <a href="{{ route('registreer') }}">registreer</a>
@endguest
@auth
<a href="{{ route('overzicht') }}">overzicht</a>
<a href="{{ route('aanmaken') }}">aanmaken</a>
<a href="{{ route('aanpassen') }}">aanpassen</a>
<a href="{{ route('contactenlijst') }}">contactenlijst</a>   
<a href="{{ route('instellingen') }}">instellingen</a> 
@endauth
