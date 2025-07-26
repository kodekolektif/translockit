<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceResource\Pages;
use App\Filament\Resources\ServiceResource\RelationManagers;
use App\Models\Service;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Split;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-group';
    protected static ?string $navigationGroup = 'Content Management';
    protected static ?int $navigationSort = 4;

    protected static bool $shouldRegisterNavigation = false;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                FileUpload::make('icon') // The name 'icon' MUST match your code
                    ->image() // Optional: for image previews and validation
                    ->disk('public') // Tell Filament to use the public disk
                    ->required() // Or ->nullable() if the icon is not required
                    ->columnSpanFull(),

                Section::make('English (EN)')
                    ->collapsible()
                    ->schema([
                        TextInput::make('title.en')
                            ->label('Title (EN)')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('description.en')
                            ->label('Description (EN)')
                            ->maxLength(500),
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
                        TextInput::make('description.es')
                            ->label('Description (ES)')
                            ->maxLength(500),
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
                ImageColumn::make('icon')
                    ->disk('public')
                    ->label('Icon'),

                TextColumn::make('title')
                    ->label('Title')
                    ->limit(30)
                    ->tooltip(fn (Model $record): string => $record->sibling?->title)
                    ->sortable()
                    ->searchable(),
                TextColumn::make('description')
                    ->label('Description')
                    ->limit(50)
                    ->tooltip(fn (Model $record): string => $record->sibling?->description)
                    ->sortable(),

                ToggleColumn::make('is_active')
                    ->label('Active')
                    ->updateStateUsing(function (Model $record, $state): void {
                        Service::where('unique_id', $record->unique_id)
                               ->update(['is_active' => $state]);
                    }),

                TextColumn::make('updated_at')
                    ->label('Last Updated')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListServices::route('/'),
            'create' => Pages\CreateService::route('/create'),
            'edit' => Pages\EditService::route('/{record}/edit'),
        ];
    }
}
