<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = [
        'name', 'parent_id'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function region()
    {
        return $this->belongsTo('App\Model\Location', 'parent_id', 'id');
    }

    public function townships()
    {
        return $this->hasMany('App\Model\Location', 'parent_id', 'id');
    }

    public function logistic()
    {
        return $this->hasMany(Logistic::class, 'township_id');
    }

    public function scopeParent($query)
    {
        return $query->whereNull('parent_id');
    }

    public function scopeChild($query)
    {
        return $query->whereNotNull('parent_id');
    }
}
