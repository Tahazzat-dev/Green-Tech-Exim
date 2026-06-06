<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'name',
        'designation',
        'phone',
        'profile',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];
}
