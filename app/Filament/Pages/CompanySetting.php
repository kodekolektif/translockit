<?php

namespace App\Filament\Pages;

use App\Settings\Contact;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;
use Illuminate\Support\HtmlString;

class CompanySetting extends SettingsPage
{
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ?string $navigationGroup = 'Settings';
    protected static ?int $navigationSort = 99;

    protected static string $settings = \App\Settings\CompanySetting::class;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('phone')
                    ->label(__('Phone')),
                    // ->required(),
                Forms\Components\TextInput::make('email')
                    ->label(__('Email'))
                    ->required(),
                Forms\Components\TextInput::make('address')
                    ->columnSpanFull()
                    ->label(__('Address')),
                    // ->required(),
                Forms\Components\TextInput::make('google_map_url')
                    ->url()
                    ->columnSpanFull()
                    ->label(__('Google Map URL')),
                    // ->required(),
               Forms\Components\TextInput::make('embed_google_url')
                    ->url()
                    ->columnSpanFull()
                    ->label(__('Embed Google Map URL'))
                    ->helperText(new HtmlString(
                        'Generate HTML Code hire <a href="https://www.embed-map.com/" target="_blank" rel="noopener noreferrer" style="color: blue;">embed-map.com</a> and copy the url from the src attribute.'
                    )),
                    // ->required(),
        ]);
    }
}
