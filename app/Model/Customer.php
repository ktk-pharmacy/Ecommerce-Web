<?php

namespace App\Model;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    use HasApiTokens;

    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
        'provider_id',
        'provider',
        'birthday',
        'gender',
        'contact_phone_no',
        'profile_image',
        'billing_address',
        'shipping_address',
        'child_location_id',
        'order_note',
        'status',
        'verified_at'
    ];

    public const UPLOAD_PATH = 'upload/customers';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'username',
        'password',
        'provider_id',
        'provider'
    ];

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    public function getProfileImageAttribute($value)
    {
        return asset($value ?? '/assets/theme/img/orginal2.png');
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function completedOrders()
    {
        return $this->hasMany(Order::class)->status('Completed')->orderBy('id', 'DESC');
    }

    public function orderProducts()
    {
        return $this->hasManyThrough(
            OrderProduct::class,
            Order::class
        );
    }
}
