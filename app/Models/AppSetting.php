<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppSetting extends Model
{
    /** @use HasFactory<\Database\Factories\AppSettingFactory> */
    use HasFactory;

    protected $fillable = [
        'whatsapp_phone',
        'facebook_page_url',
    ];

    public static function current(): self
    {
        return static::firstOrCreate(['id' => 1]);
    }

    public function normalizedWhatsAppPhone(): ?string
    {
        if (! $this->whatsapp_phone) {
            return null;
        }

        $phone = preg_replace('/\D+/', '', $this->whatsapp_phone);

        if (! $phone) {
            return null;
        }

        if (str_starts_with($phone, '0')) {
            return '880'.substr($phone, 1);
        }

        return $phone;
    }

    public function whatsAppUrl(?string $message = null): ?string
    {
        $phone = $this->normalizedWhatsAppPhone();

        if (! $phone) {
            return null;
        }

        $url = 'https://wa.me/'.$phone;

        if ($message) {
            $url .= '?text='.rawurlencode($message);
        }

        return $url;
    }
}
