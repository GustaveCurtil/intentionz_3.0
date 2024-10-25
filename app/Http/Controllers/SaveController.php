<?php

namespace App\Http\Controllers;

use App\Models\Save;
use App\Models\Event;
use Illuminate\Http\Request;

class SaveController extends Controller
{
    public function saveEvent(Event $event, Request $request) 
    {
        $userId = auth()->guard()->id();
        $eventSave = Save::where('user_id', $userId)
        ->where('event_id', $event->id)->first();

        if ($eventSave) {
            if ($request->input('opslaan') === "opslaan") {
                $eventSave->saved = true;
            } else {
                $eventSave->saved = false;
            }
            $eventSave->save();
        } else {
            $eventSave = Save::create([
                'user_id' => $userId,
                'event_id' => $event->id,
                'saved' => true  // Assuming you're passing the Event model
            ]);
        }

        if($eventSave->saved) {
            // return redirect()->back();  
        }

        return redirect()->back();
    }
}
