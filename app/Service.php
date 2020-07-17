<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['title', 'description', 'when', 'created_by', 'status',
        'count', 'upper_deck', 'lower_deck'];

    public function bookings(){
        return $this->hasMany(Booking::class, 'service_id');
    }

    public function approved_lower_deck(){
        return $this->bookings()->where('status', Booking::STATUS_APPROVED)
            ->where('deck', 'lower_deck');
    }

    public function approved_upper_deck(){
        return $this->bookings()->where('status', Booking::STATUS_APPROVED)
            ->where('deck', 'upper_deck');
    }

    public function getTotalMaxAttribute(){
        return $this->lower_deck + $this->upper_deck;
    }

    public function pending(){
        return $this->bookings()->where('status', Booking::STATUS_PENDING);
    }

    public function rejected(){
        return $this->bookings()->where('status', Booking::STATUS_REJECTED);
    }

    protected $appends = ['total_max'];
}
