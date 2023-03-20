<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MobileAdsVideo extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'reference_id',
        'reference_type',
        'video_url',
        'type',
        'sorting',
        'status',
        'deleted_at',
    ];

    const TYPES = [
        'video',
    ];

    const UPLOAD_PATH = 'upload/home';
    const VIDEO = 'video';

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

    public function getVideoUrlAttribute($value)
    {
        return asset($value);
    }
}
