<?php

namespace App\Model;

use DateTime;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'brand_id',
        'category_id',
        'description',
        'feature_image',
        'price',
        'sale_price',
        'discount_amount',
        'discount_type',
        'discount_from',
        'discount_to',
        'stock',
        'net_weight',
        'gross_weight',
        'uom',
        'sold_count',
        'is_new',
        'status',
        'deleted_at'
    ];

    public const UPLOAD_PATH = 'upload/products';

    protected $casts = [
        'discount_from' => 'datetime:d-m-Y',
        'discount_to' => 'datetime:d-m-Y',
    ];

    public function scopePublish($query)
    {
        return $query->whereNull('deleted_at');
    }

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    public function scopeNew($query)
    {
        return $query->where('is_new', true);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function sub_category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function getFeatureImageAttribute($value)
    {
        return asset($value);
    }

    public function galleries()
    {
        return $this->morphMany(Media::class, 'mediable');
    }

    public function getIsPromotionAttribute()
    {
        return $this->price > $this->sale_price;
    }

    public function getDiscountToAttribute($value)
    {
        $date = new DateTime($value);
        return $date->modify('-1 day')->format('d-m-Y');
    }

    public function hasDiscount()
    {
        return $this->discount_amount && $this->discount_from <= today() && $this->discount_to >= today()->format('d-m-Y');
    }

    public function getDiscountAttribute()
    {
        if ($this->hasDiscount()) {
            if ($this->discount_type == "PERCENT") {
                $discount = ($this->sale_price / 100) * $this->discount_amount;
            } else {
                $discount = $this->discount_amount;
            }
            $discount = $this->sale_price - $discount;

            return $discount;
        }
        return null;
    }
}
