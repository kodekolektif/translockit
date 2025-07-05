<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SoftwareResource\Pages;
use App\Filament\Resources\SoftwareResource\RelationManagers;
use App\Models\Product;
use App\Models\Service;
use App\Services\Translation as TranslatorService;
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

class SoftwareResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-computer-desktop';
    protected static ?string $navigationLabel = 'Software';
  protected static ?string $navigationGroup = 'Content Management';
    protected static ?int $navigationSort = 6;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                FileUpload::make('logo') // The name 'icon' MUST match your code
                    ->image() // Optional: for image previews and validation
                    ->disk('public') // Tell Filament to use the public disk
                    ->required() // Or ->nullable() if the icon is not required
                    ->columnSpanFull(),
                TextInput::make('name')
                    ->label('Name')
                    ->required()
                    ->columnSpanFull()
                    ->maxLength(255),

                Section::make('English (EN)')
                    ->collapsible()
                    ->schema([
                        RichEditor::make('description.en')
                            ->label('Description (EN)'),
                    ]),
                Forms\Components\Actions::make([
                    Forms\Components\Actions\Action::make('Make Spanish Translation')
                        ->action(function (Forms\Get $get, Forms\Set $set) {
                            $descriptionEn = $get('description.en');

                            // Call your Gemini class
                            $translator = new TranslatorService();
                            $descriptionEs = $translator->translate($descriptionEn, 'es');

                            $set('description.es', $descriptionEs);
                        })
                        ->icon('heroicon-o-language'),
                ]),
                Section::make('Spanish (ES)')
                    ->collapsible()
                    ->schema([
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
                ImageColumn::make('logo')
                    ->disk('public')
                    ->label('Logo'),

                TextColumn::make('name')
                    ->label('Name')
                    ->limit(30)
                    ->description(fn (Model $record): string => strip_tags(Str::limit($record->sibling->description, 100)))
                    ->sortable()
                    ->searchable(),

                ToggleColumn::make('is_active')
                    ->label('Active')
                    ->updateStateUsing(function (Model $record, $state): void {
                        Product::where('unique_id', $record->unique_id)
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
            'index' => Pages\ListSoftware::route('/'),
            'create' => Pages\CreateSoftware::route('/create'),
            'edit' => Pages\EditSoftware::route('/{record}/edit'),
        ];
    }
}
