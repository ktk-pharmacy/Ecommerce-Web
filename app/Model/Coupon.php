<?php

namespace App\Model;

use Carbon\Carbon;
use DateTime;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = [
        'name',
        'amount',
        'type',
        'limit_per_coupon',
        'limit_per_user',
        'min_amount',
        'from',
        'to',
        'status',
        'deleted_at'
    ];

    protected $casts = [
        'from' => 'datetime:d-M-Y',
        'to' => 'datetime:d-M-Y',
    ];

    protected $appends = [
        'is_valid'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function orders()
    {
        return $this->hasMany(Order::class)->notEqualStatus('Canceled');
    }

    public function scopePublish($query)
    {
        return $query->whereNull('deleted_at');
    }

    public function scopeActive($query)
    {
        return $query->where('status', true)->whereNull('deleted_at');
    }

    public function scopeValid($query)
    {
        //active, current, publish
        return $query->where([
            'status' => true,
            'deleted_at' => null
        ])->whereDate('from', '<=', today())->whereDate('to', '>', today());
    }

    public function getToAttribute($value)
    {
        $end_date = new DateTime($value);
        return $end_date->modify('-1 day')->format('d-M-Y');
    }

    public function getIsValidAttribute()
    {
        $nowDate = Carbon::now();
        $fromDate = $this->from;

        $end_date = new DateTime($this->to);
        $toDate = $end_date->modify('+1 day');

        $fromDateIsValid = $nowDate->greaterThanOrEqualTo($fromDate);
        $toDateIsValid = $nowDate->lessThan($toDate);

        return $fromDateIsValid == $toDateIsValid;
    }

    public static function findByName(string $name): ?Coupon
    {
        return static::with('orders')->publish()->where('name', $name)->get()->first();
    }
}
