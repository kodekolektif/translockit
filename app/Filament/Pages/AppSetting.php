<?php

namespace App\Filament\Pages;

use App\Settings\AppSettings;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;

class AppSetting extends SettingsPage
{
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string $settings = AppSettings::class;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Application Settings')
                    ->description('Configure your application settings here.')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('APP Title')
                            ->maxLength(255),
                        Forms\Components\Textarea::make('description')
                            ->label('App Description')
                            ->maxLength(500),
                        Forms\Components\TextInput::make('keywords')
                            ->label('App Keywords')
                            ->placeholder('Enter keywords separated by commas')
                            ->helperText('Separate each keyword with a comma'),

                        Forms\Components\FileUpload::make('favicon')
                            ->label('Favicon')
                            ->image(),

                        Forms\Components\FileUpload::make('logo')
                            ->label('Logo')
                            ->image(),

                        Forms\Components\FileUpload::make('logo_dark')
                            ->label('Dark Mode Logo')
                            ->image(),
                        Forms\Components\Select::make('default_language')
                            ->label('Default Language')
                            ->options([
                                'en' => 'English',
                                'es' => 'Spanish',
                            ])
                            ->default('en'),
                    ]),

                Forms\Components\Section::make('Translation Settings')
                    ->description('Configure your translation service settings.')
                    ->schema([
                        Forms\Components\TextInput::make('gemini_api_key')
                            ->label('Gemini API Key')
                            ->password(),

                        Forms\Components\TextInput::make('gemini_api_url')
                            ->label('Gemini API URL')
                            ->url()
                            ->default('https://api.gemini.com/v1/translate'),
                        Forms\Components\TextInput::make('openai_api_key')
                            ->label('OpenAI API Key')
                            ->password(),

                        Forms\Components\TextInput::make('openai_api_url')
                            ->label('OpenAI API URL')
                            ->url()
                            ->default('https://api.openai.com/v1/translate'),

                        Forms\Components\Select::make('translation_ai_service')
                            ->label('Translation AI Service')
                            ->options([
                                'gemini' => 'Gemini AI',
                                'openai' => 'OpenAI',
                                // Add more services as needed
                            ])
                            ->default('gemini'),
                ])->columns(2),


            ]);
    }
}
