<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Otp extends Model
{
    protected $fillable = [
        'username',
        'code',
        'status'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
