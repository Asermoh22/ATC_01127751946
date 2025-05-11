<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'Event_Name',
        'Description',
        'category_id',
        'Date',
        'Venue',
        'price',
        'image',
    ];

    public function Category(){
        return $this->belongsTo(Category::class);
    }
    public function bookings(){
        return $this->hasMany(Booking::class);
    }

}
