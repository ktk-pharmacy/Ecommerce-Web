<?php

namespace App;

use App\Model\Logistic;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryCharge extends Model
{
    protected $fillable = [
        'logistic_id',
        'type',
        'amount'
    ];

    public function scopeValid($query)
    {
        return $query->whereNotNull('amount')->where('amount', '>', 0);
    }

    public function scopeOnlyPremium($query)
    {
        return $query->where('type','premium');
    }

    public function logistic(){
        return $this->belongsTo(Logistic::class ,'logistic_id');
    }
}
