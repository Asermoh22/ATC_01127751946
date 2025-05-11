<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'event_id',
        'user_id',
        'quantity',
    ];

    public function Event(){
        return $this->belongsTo(Event::class);
    }

    public function User(){
        return $this->belongsTo(User::class);
    }
}
