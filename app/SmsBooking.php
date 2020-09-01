<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SmsBooking extends Model
{
    protected $fillable = ['request_id', 'service_id', 'phone', 'names', 'status', 'location',  'id_number'];
}
