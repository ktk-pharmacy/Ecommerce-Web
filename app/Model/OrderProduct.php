<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    protected $fillable = [
        'order_id',
        'product_id',
        'price',
        'sale_price',
        'quantity',
        'discount_amount',
        'discount_type',
        'discount_total',
        'order_product_total',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function completeOrder()
    {
        return $this->belongsTo(Order::class, 'order_id')->status(Order::COMPLETED,Order::DELIVER);
    }
}
