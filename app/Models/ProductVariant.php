<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    protected $fillable = [
        'product_id',
        'label',
        'amount',
        'discount_price',
        'size_inch',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}