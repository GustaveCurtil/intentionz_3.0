<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Save extends Model
{
        protected $fillable = [
        'user_id', 
        'event_id', 
        'saved'
        ];

        public function event()
        {
            return $this->belongsTo(Event::class, 'event_id');
        }
    
        public function user()
        {
            return $this->belongsTo(User::class, 'user_id');
        }
}
