<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    protected $fillable = [
        'name',
        'slider_text1',
        'slider_text2',
        'image_url',
        'link',
        'type',
        'sorting',
        'btn_txt',
        'status',
        'deleted_at',
    ];

    const TYPES = [
        'slider',
        'slider_sidebar',
        'left_sidebar',
        'second_slider',
        'banner_1',
        'banner_2'
    ];

    const UPLOAD_PATH = 'upload/home';

    const SLIDER = 'slider';
    const SLIDER_SIDEBAR = 'slider_sidebar';
    const SECOND_SLIDER = 'second_slider';
    const LEFT_SIDEBAR  = 'left_sidebar';
    const BANNER_1 = 'banner_1';
    const BANNER_2 = 'banner_2';


    const SLIDER_SIDERBAR_MAX_COUNT = 2;

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
