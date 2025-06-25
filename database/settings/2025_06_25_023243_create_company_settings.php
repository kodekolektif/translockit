<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('company.phone','');
        $this->migrator->add('company.email','');
        $this->migrator->add('company.address','');
        $this->migrator->add('company.google_map_url','');
        $this->migrator->add('company.embed_google_url','');
    }
};
