<?php

namespace App\Model;

use App\Model\Location;
use Illuminate\Database\Eloquent\Model;

class DeliveryInformation extends Model
{
    protected $fillable = [
       'name',
       'contact_phone_no',
       'city',
       'township',
       'billing_address',
       'shipping_address',
       'order_note'
    ];
    public function cityInfo(){
        return $this->belongsTo(Location::class, 'city' );
    }
    public function townshipInfo(){
        return $this->belongsTo(Location::class, 'township' );
    }
}
