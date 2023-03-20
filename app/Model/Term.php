<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    protected $fillable = [
        'name',
        'deleted_at'
    ];

    public function scopePublish($query)
    {
        return $query->whereNull('deleted_at');
    }

    public function publishPosts()
    {
        return $this->belongsToMany(Post::class, 'post_term')->publish();
    }

    public function posts()
    {
        return $this->belongsToMany(Post::class)->using(PostTerm::class);
    }
}
