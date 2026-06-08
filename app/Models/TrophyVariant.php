<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrophyVariant extends Model
{
    protected $fillable = [
        'trophy_id',
        'label',
        'amount',
        'discount_price',
        'size',
    ];

    public function trophy()
    {
        return $this->belongsTo(Trophy::class);
    }
}