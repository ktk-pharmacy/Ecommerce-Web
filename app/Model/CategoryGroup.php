<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CategoryGroup extends Model
{
    protected $fillable = [
        'name',
        'image_url',
        'status',
        'sorting',
        'deleted_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'status',
        'deleted_at',
        'created_at',
        'updated_at',
    ];

    public const UPLOAD_PATH = 'upload/categories';

    public function scopePublish($query)
    {
        return $query->whereNull('deleted_at');
    }

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    public function mainCategories()
    {
        return $this->hasMany(Category::class)->active();
    }

    public function getImageUrlAttribute($value)
    {
        return asset($value);
    }
}
