<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['title', 'description', 'when', 'created_by', 'status', 'count',];

    public function bookings(){
        return $this->hasMany(Booking::class, 'service_id');
    }

    public function approved(){
        return $this->bookings()->where('status', Booking::STATUS_APPROVED);
    }

    public function pending(){
        return $this->bookings()->where('status', Booking::STATUS_PENDING);
    }

    public function rejected(){
        return $this->bookings()->where('status', Booking::STATUS_REJECTED);
    }
}
