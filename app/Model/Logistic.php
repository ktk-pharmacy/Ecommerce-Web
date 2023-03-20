<?php

namespace App\Model;

use App\DeliveryCharge;
use Illuminate\Database\Eloquent\Model;

class Logistic extends Model
{
    protected $fillable = [
        'type',
        'city_id',
        'township_id',
        'area_description',
        'min_order_total'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function scopeType($query, $type)
    {
        return $query->where('type', $type);
    }

    public function city()
    {
        return $this->belongsTo(Location::class, 'city_id');
    }

    public function township()
    {
        return $this->belongsTo(Location::class, 'township_id');
    }

    public function deliveryCharges()
    {
        return $this->hasMany(DeliveryCharge::class, 'logistic_id');
    }

    public function deliveryFees()
    {
        return $this->hasMany(DeliveryCharge::class, 'logistic_id')->valid();
    }
}
