<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AuthorResource\Pages;
use App\Filament\Resources\AuthorResource\RelationManagers;
use App\Models\Author;
use Filament\Actions\Action;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class AuthorResource extends Resource
{
    protected static ?string $model = Author::class;
    protected static ?string $navigationGroup = 'Content Management';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                FileUpload::make('profile') // The name 'icon' MUST match your code
                        ->label('Profle Picture') // Optional: label for the field
                        ->image() // Optional: for image previews and validation
                        ->disk('public') // Tell Filament to use the public disk
                        ->required() // Or ->nullable() if the icon is not required
                        ->columnSpanFull(),
                TextInput::make('name')
                    ->maxLength(255)
                     ->columnSpanFull(),
                Section::make('English (EN)')
                    ->collapsible()
                    ->schema([
                        TextInput::make('title.en')
                            ->label('Title (EN)')
                            ->maxLength(255),
                        RichEditor::make('description.en')
                            ->label('Content (EN)'),
                    ]),
                    Forms\Components\Actions::make([
                        Forms\Components\Actions\Action::make('Make Spanish Translation')
                            ->action(function (Forms\Get $get, Forms\Set $set) {
                                $titleEn = $get('title.en');
                                $description = $get('description.en');

                                // Call your Gemini class
                                $translator = new \App\Libs\GeminiAI(app(\App\Settings\AppSettings::class));
                                $titleEs = $translator->translate($titleEn, 'es');
                                $descriptionEs = $translator->translate($description, 'es');

                                // Set translated fields
                                $set('title.es', $titleEs);
                                $set('description.es', $descriptionEs);
                            })
                            ->icon('heroicon-o-language'),
                    ]),
                Section::make('Spanish (es)')
                    ->collapsible()
                    ->schema([
                        TextInput::make('title.es')
                            ->label('Title (ES)')
                            ->maxLength(255),
                        RichEditor::make('description.es')
                            ->label('Content (ES)'),
                    ]),
                Section::make('Social Account')
                    ->collapsible()
                    ->schema([
                        TextInput::make('social_instagram')
                            ->label('Instagram')
                            ->url()
                            ->placeholder('https://instagram.com/username')
                            ->prefix(fn () => 'instagram')
                            ->extraAttributes(['class' => 'pl-10'])
                            ->maxLength(255)
                            ->inlineLabel(false)
                            ->prefixIcon(null),

                        TextInput::make('social_linkedin')
                            ->label('LinkedIn')
                            ->url()
                            ->placeholder('https://www.linkedin.com/in/username')
                            ->prefix(fn () => 'linkedIn')
                            ->extraAttributes(['class' => 'pl-10'])
                            ->maxLength(255),

                        TextInput::make('social_facebook')
                            ->label('Facebook')
                            ->url()
                            ->placeholder('https://facebook.com/username')
                            ->prefix(fn () => 'facebook')
                            ->extraAttributes(['class' => 'pl-10'])
                            ->maxLength(255),

                        TextInput::make('social_twitter')
                            ->label('Twitter')
                            ->url()
                            ->placeholder('https://x.com/username')
                            ->prefix(fn () => 'twitter')
                            ->extraAttributes(['class' => 'pl-10'])
                            ->maxLength(255),

                    ]),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function (Builder $query) {
                $query->where('lang', 'en')->with('sibling');
            })
            ->columns([
                ImageColumn::make('profile'),
                TextColumn::make('name')
                    ->label('Name')
                    ->description(fn (Author $record): string => strip_tags(Str::limit($record->title,100))),
                TextColumn::make('description')

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ActionGroup::make([
                    Action::make('instagram')
                        ->label('Instagram')
                        ->color('danger')
                        ->visible(fn ($record) => filled($record->social_instagram))
                        ->url(fn ($record) => $record->social_instagram, shouldOpenInNewTab: true),

                    Action::make('linkedin')
                        ->label('LinkedIn')
                        ->color('indigo')
                        ->visible(fn ($record) => filled($record->social_linkedin))
                        ->url(fn ($record) => $record->social_linkedin, shouldOpenInNewTab: true),

                    Action::make('facebook')
                        ->label('Facebook')
                        ->color('info')
                        ->visible(fn ($record) => filled($record->social_facebook))
                        ->url(fn ($record) => $record->social_facebook, shouldOpenInNewTab: true),

                    Action::make('twitter')
                        ->label('Twitter')
                        ->color('gray')
                        ->visible(fn ($record) => filled($record->social_twitter))
                        ->url(fn ($record) => $record->social_twitter, shouldOpenInNewTab: true),
                ])
                ->label('Social Links')
                ->icon('heroicon-o-share')
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAuthors::route('/'),
            'create' => Pages\CreateAuthor::route('/create'),
            'edit' => Pages\EditAuthor::route('/{record}/edit'),
        ];
    }
}
