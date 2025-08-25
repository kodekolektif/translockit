<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Filament\Resources\ProjectResource\RelationManagers;
use App\Services\Translation as TranslatorService;
use App\Models\Project;
use App\Models\Service;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\Hidden;
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

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static ?string $navigationIcon = 'heroicon-o-chart-bar-square';
    protected static ?string $navigationGroup = 'Content Management';
    protected static ?int $navigationSort = 7;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Forms\Components\FileUpload::make('image') // The name 'icon' MUST match your code
                //     ->image() // Optional: for image previews and validation
                //     ->disk('public') // Tell Filament to use the public disk
                //     ->required() // Or ->nullable() if the icon is not required
                //     ->label('Image')
                //     ->columnSpanFull(),
                FileUpload::make('image') // The name 'logo' MUST match your code
                    ->image() // Optional: for image previews and validation
                    ->disk('public') // Tell Filament to use the public disk
                    ->required() // Or ->nullable() if the image is not required
                    ->columnSpanFull(),

                // Forms\Components\Select::make('service_id')
                //     ->label('Service')
                //     ->options(
                //         \App\Models\Service::where(['is_active' => 1])
                //         ->groupBy('unique_id')
                //         ->pluck('title', 'unique_id')
                //     )
                //     ->required()
                //     ->searchable()
                //     ->columnSpanFull(),
                Hidden::make('service_id')
                ->default(0), // Gunakan default() untuk mengatur nilai awal/default


                 Forms\Components\Section::make('English (EN)')
                    ->collapsible()
                    ->schema([
                        Forms\Components\TextInput::make('name.en')
                            ->label('Name (EN)')
                            ->required()
                            ->columnSpanFull()
                            ->maxLength(255),
                        Forms\Components\RichEditor::make('description.en')
                            ->label('Description (EN)'),
                    ]),
                Forms\Components\Actions::make([
                    Forms\Components\Actions\Action::make('Make Spanish Translation')
                        ->action(function (Forms\Get $get, Forms\Set $set) {
                            $nameEn = $get('name.en');
                            $descriptionEn = $get('description.en');

                            // Call your Gemini class
                            $translator = new TranslatorService();
                            $nameEs = $translator->translate($nameEn, 'es');
                            $descriptionEs = $translator->translate($descriptionEn, 'es');

                            $set('name.es', $nameEs);
                            $set('description.es', $descriptionEs);
                        })
                        ->icon('heroicon-o-language'),
                ]),
                 Forms\Components\Section::make('Spanish (ES)')
                    ->collapsible()
                    ->schema([
                        Forms\Components\TextInput::make('name.es')
                            ->label('Name (ES)')
                            ->required()
                            ->columnSpanFull()
                            ->maxLength(255),
                        Forms\Components\RichEditor::make('description.es')
                            ->label('Description (ES)'),
                    ]),

                Forms\Components\Toggle::make('is_active')
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
                ImageColumn::make('image')
                    ->disk('public')
                    ->label('Image'),

                TextColumn::make('name')
                    ->label('Name')
                    ->limit(30)
                    ->sortable()
                    // remove html tags if needed and limit to 100
                    ->description(fn (Model $record): string => strip_tags(Str::limit($record->description ?? '', 100)))
                    ->searchable(),

                TextColumn::make('updated_at')
                    ->label('Last Updated')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('order')
                ->label('Number of View')


            ])

            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),

                Action::make('increment')
                ->label('+')
                ->button()
                ->color('success') // green styling
               ->action(function ($record) {
                    $modelClass = get_class($record);

                    $modelClass::where('unique_id', $record->unique_id)->increment('order');

                    // Optional: refresh page or table
                }),

                Action::make('decrement')
                    ->label('-')
                    ->button() // pastikan ini disetel agar tampil sebagai <button>
                    ->color('danger') // red styling
                    ->action(function ($record) {
                        $modelClass = get_class($record);

                        $modelClass::where('unique_id', $record->unique_id)->decrement('order');

                        // Optional: refresh page or table
                    }),
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
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }
}
