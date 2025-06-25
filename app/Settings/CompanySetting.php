<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class CompanySetting extends Settings
{

    public string $phone;
    public string $email;
    public string $address;
    public string $google_map_url;
    public string $embed_google_url;

    public static function group(): string
    {
        return 'company';
    }
}
