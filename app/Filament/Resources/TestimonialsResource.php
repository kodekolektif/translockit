<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TestimonialsResource\Pages;
use App\Filament\Resources\TestimonialsResource\RelationManagers;
use App\Models\Testimonial;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TestimonialsResource extends Resource
{
    protected static ?string $model = Testimonial::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';
    protected static ?string $navigationGroup = 'Content Management';
    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                 Section::make('English (EN)')
                    ->collapsible()
                    ->schema([
                        // Forms\Components\FileUpload::make('image.en')
                        //     ->image()
                        //     ->disk('public')
                        //     ->nullable()
                        //     ->columnSpanFull()
                        //     ->label('Image'),
                        Forms\Components\TextInput::make('name.en')
                            ->placeholder('John Doe')
                            ->required()
                            ->maxLength(255)
                            ->label('Name'),
                        Forms\Components\TextInput::make('title.en')
                            ->placeholder('IT Software Engineer')
                            ->required()
                            ->maxLength(255)
                            ->label('Title'),
                        Forms\Components\Textarea::make('content.en')
                            ->required()
                            ->maxLength(1000)
                            ->columnSpanFull()
                            ->label('Testimonial'),
                ]),

                Forms\Components\Actions::make([
                    Forms\Components\Actions\Action::make('Make Spanish Translation')
                        ->action(function (Forms\Get $get, Forms\Set $set) {
                            $nameEn = $get('name.en');
                            $titleEn = $get('title.en');
                            $contentEn = $get('content.en');

                            // Call your Gemini class
                            $translator = new \App\Libs\GeminiAI(app(\App\Settings\AppSettings::class));
                            $contentEs = $translator->translate($contentEn, 'es');

                            // Set translated fields
                            $set('name.es', $nameEn);
                            $set('title.es', $titleEn);
                            $set('content.es', $contentEs);
                        })
                        ->icon('heroicon-o-language'),
                ]),

                Section::make('Spanish (ES)')
                    ->collapsible()
                    ->schema([
                        // Forms\Components\FileUpload::make('image.es')
                        //     ->image()
                        //     ->disk('public')
                        //     ->nullable()
                        //     ->columnSpanFull()
                        //     ->label('Image'),
                        Forms\Components\TextInput::make('name.es')
                            ->placeholder('John Doe')
                            ->required()
                            ->maxLength(255)
                            ->label('Name'),
                        Forms\Components\TextInput::make('title.es')
                            ->placeholder('IT Software Engineer')
                            ->required()
                            ->maxLength(255)
                            ->label('Title'),
                        Forms\Components\Textarea::make('content.es')
                            ->required()
                            ->maxLength(1000)
                            ->columnSpanFull()
                            ->label('Testimonial'),
                    ]),
                Forms\Components\Toggle::make('is_active')
                    ->label('Is Active')
                    ->default(true)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function (Builder $query) {
                $query->where('lang', 'en')->with('sibling');
            })
            ->columns([
                // Tables\Columns\ImageColumn::make('image')
                //     ->disk('public')
                //     ->label('Image'),
                Tables\Columns\TextColumn::make('name')
                    ->label('Name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('title')
                    ->label('Title')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('content')
                    ->label('Testimonial')
                    ->tooltip(fn (Model $record): string => $record->sibling?->content ?? '')
                    ->limit(50)
                    ->searchable(),
                Tables\Columns\ToggleColumn::make('is_active')
                    ->label('Active')
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
            'index' => Pages\ListTestimonials::route('/'),
            'create' => Pages\CreateTestimonials::route('/create'),
            'edit' => Pages\EditTestimonials::route('/{record}/edit'),
        ];
    }
}
