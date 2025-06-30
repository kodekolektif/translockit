<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MobileListResource\Pages;
use App\Filament\Resources\MobileListResource\RelationManagers;
use App\Models\MobileList;
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

class MobileListResource extends Resource
{
    protected static ?string $model = MobileList::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                FileUpload::make('logo') // The name 'logo' MUST match your code
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
                    ]),
                Forms\Components\Actions::make([
                    Forms\Components\Actions\Action::make('Make Spanish Translation')
                        ->action(function (Forms\Get $get, Forms\Set $set) {
                            $titleEn = $get('title.en');

                            // Call your Gemini class
                            $translator = new \App\Libs\GeminiAI(app(\App\Settings\AppSettings::class));
                            $titleEs = $translator->translate($titleEn, 'es');

                            // Set translated fields
                            $set('title.es', $titleEs);
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
                 Tables\Columns\ImageColumn::make('logo')
                    ->label('Logo')
                    ->disk('public')
                    ->circular()
                    ->size(50),
                Tables\Columns\TextColumn::make('title')
                    ->label('Title')
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
            'index' => Pages\ListMobileLists::route('/'),
            'create' => Pages\CreateMobileList::route('/create'),
            'edit' => Pages\EditMobileList::route('/{record}/edit'),
        ];
    }
}
