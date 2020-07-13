<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    const STATUS_PENDING = 0;
    const STATUS_APPROVED = 1;
    const STATUS_REJECTED = -1;

    protected $fillable = ['request_id', 'service_id', 'phone', 'names', 'status', 'seat'];

    public function service(){
        return $this->belongsTo(Service::class, 'service_id');
    }
}
