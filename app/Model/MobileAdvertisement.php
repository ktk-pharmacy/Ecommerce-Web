<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MobileAdvertisement extends Model
{
    protected $fillable = [
        'name',
        'reference_id',
        'reference_type',
        'image_url',
        'type',
        'sorting',
        'status',
        'deleted_at',
    ];

    const TYPES = [
        'slider',
    ];

    const UPLOAD_PATH = 'upload/home';
    const SLIDER = 'slider';

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function scopePublish($query)
    {
        return $query->whereNull('deleted_at');
    }

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    public function scopeType($query, $type)
    {
        return $query->where('type', $type);
    }

    public function getImageUrlAttribute($value)
    {
        return asset($value);
    }
}
