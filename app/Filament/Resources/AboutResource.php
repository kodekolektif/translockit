<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AboutResource\Pages;
use App\Filament\Resources\AboutResource\RelationManagers;
use App\Models\About;
use App\Services\Translation as TranslationServices;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
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

class AboutResource extends Resource
{
    protected static ?string $model = About::class;

    protected static ?string $navigationIcon = 'heroicon-o-information-circle';
    protected static ?string $navigationGroup = 'Content Management';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                FileUpload::make('image') // The name 'icon' MUST match your code
                        ->label('Image') // Optional: label for the field
                        ->image() // Optional: for image previews and validation
                        ->disk('public') // Tell Filament to use the public disk
                        ->required() // Or ->nullable() if the icon is not required
                        ->columnSpanFull(),
               Section::make('English (en)') // Assuming you have an English section defined elsewhere
                    ->collapsible()
                    ->schema([
                        TextInput::make('title.en')
                            ->label('Title (EN)')
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
                            $translator = new TranslationServices();
                            $titleEs = $translator->translate($titleEn, 'es');
                            $descriptionEs = $translator->translate($descriptionEn, 'es');

                            // Set translated fields
                            $set('title.es', $titleEs);
                            $set('description.es', $descriptionEs);
                        })
                        ->icon('heroicon-o-language'),
                ]),

                // This is the CORRECT place for the Spanish section, only once.
                Section::make('Spanish (es)')
                    ->collapsible()
                    ->schema([
                        TextInput::make('title.es')
                            ->label('Title (ES)')
                            ->maxLength(255),
                        RichEditor::make('description.es')
                            ->label('Description (ES)'),
                    ]),
                Toggle::make('is_active')
                    ->label('Published')
                    ->default(true)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function (Builder $query) {
                $query->where('lang', 'en')->with('sibling');
            })
            ->columns([
                ImageColumn::make('image')
                    ->disk('public')
                    ->label('image'),
                TextColumn::make('title')
                    ->description(fn (About $record): string => strip_tags(Str::limit($record->description, 100)))
                    ->label('Title')
                    ->limit(50)
                    ->sortable()
                    ->searchable(),
                 ToggleColumn::make('is_active')
                    ->label('Active')
                    ->updateStateUsing(function (Model $record, $state): void {
                        About::where('unique_id', $record->unique_id)
                               ->update(['is_active' => $state]);
                    }),

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
            'index' => Pages\ListAbouts::route('/'),
            'create' => Pages\CreateAbout::route('/create'),
            'edit' => Pages\EditAbout::route('/{record}/edit'),
        ];
    }
}
