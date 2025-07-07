<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class CompanySetting extends Settings
{

    public ?string $phone = null;
    public ?string $email = null;
    public ?string $address = null;
    public ?string $google_map_url = null;
    public ?string $embed_google_url = null;


    public static function group(): string
    {
        return 'company';
    }
}
