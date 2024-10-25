<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'user_id',
        'titel',        // Event title
        'locatie_naam', // Location name
        'datum',        // Date of the event
        'tijd',         // Time of the event
        'beschrijving', // Description of the event
        'foto_pad',         // Path to the event's image
        'locatie_url',
        'invitation_slug',  // URL link to the location (like Google Maps)
        'publiek',      // Boolean indicating if the event is public
        'zoom',         // Zoom level (optional range slider input)
        'horizontaal', // Left-right range input
        'verticaal',  // Top-bottom range input
    ];

    // Specify casting for specific columns
    protected $casts = [
        'datum' => 'date',        // Casting the 'datum' field as a date       // Casting the 'tijd' field as time
        'publiek' => 'boolean',   // Casting 'publiek' as boolean
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function invitations()
    {
        return $this->hasMany(Invitation::class, 'event_id');
    }
    
    public function goingGuests()
    {
        return $this->invitations()->where('going', true);
    }

    public function notGoingGuests()
    {
        return $this->invitations()->where('going', false);
    }

    public function saves()
    {
        return $this->hasMany(Event::class);
    }
}
