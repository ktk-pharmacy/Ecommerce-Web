<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'parent_id',
        'category_group_id',
        'status',
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

    public function scopePublish($query)
    {
        return $query->whereNull('deleted_at');
    }

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    public function scopeOnlyParent($query)
    {
        return $query->whereNull('parent_id');
    }

    public function group()
    {
        return $this->belongsTo(CategoryGroup::class, 'category_group_id');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function childs()
    {
        return $this->hasMany(Category::class, 'parent_id')->publish();
    }

    public function childCategories()
    {
        return $this->hasMany(Category::class, 'parent_id')->active();
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id')->active();
    }

    public function categoryProducts()
    {
        return $this->hasManyThrough(
            Product::class,
            self::class,
            'parent_id', // Foreign key on the sub-category table...
            'category_id', // Foreign key on the products table...
            'id', // Local key on the main-category table...
            'id' // Local key on the sub-category table...
        )->where('products.status', true)->whereNull('products.deleted_at');
    }
}
