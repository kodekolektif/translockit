<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('appSettings.title', 'Translock IT');
        $this->migrator->add('appSettings.description', 'A powerful translation service using Gemini AI.');
        $this->migrator->add('appSettings.keywords', 'translation, gemini, ai, multilingual');
        $this->migrator->add('appSettings.favicon', 'favicon.ico');
        $this->migrator->add('appSettings.logo', 'logo.png');
        $this->migrator->add('appSettings.logo_dark', 'logo_dark.png');

        $this->migrator->add('appSettings.gemini_api_key', '');
        $this->migrator->add('appSettings.gemini_api_url', 'https://api.gemini.com/v1/translate');

        $this->migrator->add('appSettings.default_language', 'en');
        $this->migrator->add('appSettings.supported_languages', ['en', 'es']);

        $this->migrator->add('appSettings.openai_api_key', '');
        $this->migrator->add('appSettings.openai_api_url', 'https://api.openai.com/v1/translate');

        $this->migrator->add('appSettings.default_target_language', 'es');
        $this->migrator->add('appSettings.translation_ai_service', 'gemini');
    }
};
