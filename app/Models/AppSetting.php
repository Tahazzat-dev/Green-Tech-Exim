<?php

namespace App\Models;

use Database\Factories\AppSettingFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppSetting extends Model
{
    /** @use HasFactory<AppSettingFactory> */
    use HasFactory;

    protected $fillable = [
        'whatsapp_phone',
        'navbar_phone',
        'facebook_page_url',
        'app_download_url',
    ];

    public static function current(): self
    {
        return static::firstOrCreate(['id' => 1]);
    }

    public function navbarPhoneHref(): ?string
    {
        $phone = $this->normalizedPhone($this->navbar_phone);

        if (! $phone) {
            return null;
        }

        return 'tel:+'.$phone;
    }

    public function normalizedWhatsAppPhone(): ?string
    {
        return $this->normalizedPhone($this->whatsapp_phone);
    }

    private function normalizedPhone(?string $value): ?string
    {
        if (! $value) {
            return null;
        }

        $phone = preg_replace('/\D+/', '', $value);

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
