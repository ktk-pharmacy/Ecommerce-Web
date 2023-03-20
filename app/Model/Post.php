<?php

namespace App\Model;

use App\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'feature_image',
        'user_id',
        'status',
        'view_count',
        'view_count',
        'deleted_at'
    ];

    const UPLOAD_PATH = 'upload/blogs';

    public function scopePublish($query)
    {
        return $query->whereNull('deleted_at');
    }

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    public function scopePopular($query)
    {
        return $query->orderBy('view_count', 'DESC');
    }

    public function terms()
    {
        return $this->belongsToMany(Term::class)->using(PostTerm::class);
    }

    public function getFeatureImageAttribute($value)
    {
        return asset($value);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function next()
    {
        return Post::where('id', '>', $this->id)->orderBy('id', 'asc')->first();
    }

    public function previous()
    {
        return Post::where('id', '<', $this->id)->orderBy('id', 'desc')->first();
    }

    public function getAbbreviatedPostAttribute()
    {
        return Str::limit(strip_tags($this->description), 200, '...');
    }
}
