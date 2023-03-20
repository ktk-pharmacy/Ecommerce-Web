<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $fillable = [
        'image_url',
        'file_name',
        'file_path',
        'file_type',
        'file_size',
        'mediable_id',
        'mediable_type'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function getImageUrlAttribute($value)
    {
        return asset($value);
    }

    public function mediable()
    {
        return $this->morphTo();
    }
}
