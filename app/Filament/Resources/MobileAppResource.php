<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MobileAppResource\Pages;
use App\Filament\Resources\MobileAppResource\RelationManagers;
use App\Models\MobileApp;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class MobileAppResource extends Resource
{
    protected static ?string $model = MobileApp::class;

    protected static ?string $navigationIcon = 'heroicon-o-device-phone-mobile';
    protected static ?string $navigationTitle = 'MobileApp';

    protected static ?string $navigationGroup = 'Content Management';
    protected static ?int $navigationSort = 8;


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                FileUpload::make('image') // The name 'image' MUST match your code
                    ->image() // Optional: for image previews and validation
                    ->disk('public') // Tell Filament to use the public disk
                    ->required() // Or ->nullable() if the image is not required
                    ->columnSpanFull(),

                Section::make('English (EN)')
                    ->collapsible()
                    ->schema([
                        TextInput::make('title.en')
                            ->label('Title (EN)')
                            ->required()
                            ->maxLength(255),
                        RichEditor::make('description.en')
                            ->label('Description (EN)'),
                    ]),
                Forms\Components\Actions::make([
                    Forms\Components\Actions\Action::make('Make Spanish Translation')
                        ->action(function (Forms\Get $get, Forms\Set $set) {
                            $titleEn = $get('title.en');
                            $descriptionEn = $get('description.en');

                            // Call your Gemini class
                            $translator = new \App\Libs\GeminiAI(app(\App\Settings\AppSettings::class));
                            $titleEs = $translator->translate($titleEn, 'es');
                            $descriptionEs = $translator->translate($descriptionEn, 'es');

                            // Set translated fields
                            $set('title.es', $titleEs);
                            $set('description.es', $descriptionEs);
                        })
                        ->icon('heroicon-o-language'),
                ]),
                Section::make('Spanish (ES)')
                    ->collapsible()
                    ->schema([
                        TextInput::make('title.es')
                            ->label('Title (ES)')
                            ->required()
                            ->maxLength(255),
                        RichEditor::make('description.es')
                            ->label('Description (ES)'),
                    ]),

                Toggle::make('is_active')
                    ->label('Is Active')
                    ->default(true),
                ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function (Builder $query) {
                $query->where('lang', 'en')->with('sibling');
            })
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Image')
                    ->disk('public')
                    ->circular()
                    ->size(50),
                Tables\Columns\TextColumn::make('title')
                    ->label('Title')
                    ->description(fn (MobileApp $record): string => strip_tags(Str::limit($record->description, 100)))
                    ->searchable()
                    ->sortable(),
                ToggleColumn::make('is_active')
                    ->label('Is Active')
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListMobileApps::route('/'),
            'create' => Pages\CreateMobileApp::route('/create'),
            'edit' => Pages\EditMobileApp::route('/{record}/edit'),
        ];
    }
}
