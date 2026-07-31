<?php

namespace App\Models;

use Database\Factories\PrivacyPolicyFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrivacyPolicy extends Model
{
    /** @use HasFactory<PrivacyPolicyFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
    ];

    public static function current(): self
    {
        return static::firstOrCreate(
            ['id' => 1],
            [
                'title' => 'Privacy Policy',
                'content' => 'Add your privacy policy content from the admin dashboard.',
            ]
        );
    }
}
