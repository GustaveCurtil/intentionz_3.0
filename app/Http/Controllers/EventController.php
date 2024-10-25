<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function createEvent(Request $request)
    {

        $incomingFields = $request->validate([
            'titel' => 'required|string|max:30',
            'locatie_naam' => 'nullable|string|max:50',
            'datum' => 'required|date', // Ensures the field is a valid date if filled in
            'tijd' => 'required|date_format:H:i', // Field can be null, but must be in HH:MM format if provided
            'beschrijving' => 'nullable|string|max:1000',
            'foto' => 'nullable|file|mimes:jpg,jpeg,png|max:1069',
            'locatie_url' => 'nullable|url',
            'zoom' => 'Integer',
            'horizontaal' => 'Integer',
            'verticaal' => 'Integer'
        ], [
            'titel.string' => 'De titel moet een string zijn.',
            'titel.max' => 'De titel mag maximaal 30 tekens bevatten.',
            'titel.required' => 'titel is verplicht.',
            'locatie_naam.required' => 'locatie naam is verplicht.',
            'locatie_naam.string' => 'De locatie naam moet een string zijn.',
            'locatie_naam.max' => 'De locatie naam mag maximaal 30 tekens bevatten.',
            'datum.date' => 'De datum moet een geldige datum zijn.',
            'datum.required' => 'datum is verplicht.',
            'tijd.required' => 'Tijd is verplicht.',
            'beschrijving.string' => 'De beschrijving moet een string zijn.',
            'beschrijving.max' => 'De beschrijving kan max 1000 karakters bevatten.',
            'foto.mimes' => 'De foto moet een bestand van het type jpg, jpeg of png zijn.',
            'foto.max' => 'De foto mag maximaal 1 MB groot zijn.',
            'locatie_url.url' => 'De locatie URL moet een geldige URL zijn.'
        ]);


        // Handle file upload for 'foto'
        if ($request->hasFile('foto')) {
            $image = $request->file('foto');
            $newImageName = now()->format('YmdHis') . '-' . preg_replace('/[^a-zA-Z0-9_-]/', '_', $request->titel) . '.' . $request->foto->extension();
            $path = $image->storeAs('posters', $newImageName, 'public');
            $incomingFields['foto_pad'] = $path;
        }
        $slug = Str::random(5);
        $incomingFields['invitation_slug'] = $slug;
        $incomingFields['publiek'] = $request->has('publiek') ? true : false;
        $incomingFields['user_id'] = auth()->guard()->id();

        Event::create($incomingFields);
        
        return redirect('/overzicht');
}
}
