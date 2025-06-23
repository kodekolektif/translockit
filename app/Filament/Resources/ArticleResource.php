<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ArticleResource\Pages;
use App\Filament\Resources\ArticleResource\RelationManagers;
use App\Models\Article;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TagsInput;
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

class ArticleResource extends Resource
{
    protected static ?string $model = Article::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form

            ->schema([
                    FileUpload::make('thumbnail') // The name 'icon' MUST match your code
                        ->label('Thumbnail Image') // Optional: label for the field
                        ->image() // Optional: for image previews and validation
                        ->disk('public') // Tell Filament to use the public disk
                        ->required() // Or ->nullable() if the icon is not required
                        ->columnSpanFull(),
                    Section::make('English (EN)')
                    ->collapsible()
                    ->schema([
                        TextInput::make('title.en')
                            ->label('Title (EN)')
                            ->maxLength(255),
                        RichEditor::make('content.en')
                            ->label('Content (EN)'),
                    ]),
                    Forms\Components\Actions::make([
                        Forms\Components\Actions\Action::make('Make Spanish Translation')
                            ->action(function (Forms\Get $get, Forms\Set $set) {
                                $titleEn = $get('title.en');
                                $content = $get('content.en');

                                // Call your Gemini class
                                $translator = new \App\Libs\Gemini(app(\App\Settings\AppSettings::class));
                                $titleEs = $translator->translate($titleEn, 'es');
                                $contentEs = $translator->translate($content, 'es');

                                // Set translated fields
                                $set('title.es', $titleEs);
                                $set('content.es', $contentEs);
                            })
                            ->icon('heroicon-o-language'),
                    ]),
                    Section::make('Spanish (es)')
                        ->collapsible()
                        ->schema([
                            TextInput::make('title.es')
                                ->label('Title (ES)')
                                ->maxLength(255),
                            RichEditor::make('content.es')
                                ->label('Content (ES)'),
                        ]),
                    TagsInput::make('tags')
                        ->label('Tags')
                        ->placeholder('Add tags')
                        ->columnSpanFull(),
                    Toggle::make('is_published')
                        ->label('Published')
                        ->default(false)
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
                ImageColumn::make('thumbnail'),
                TextColumn::make('title')
                    ->label('Article')
                    ->description(fn (Article $record): string => Str::limit($record->content,100)),
                TextColumn::make('published_at')
                    ->dateTime()
                    ->label('Published Date'),
                ToggleColumn::make('is_published')
                    ->label('Is Publish')
                    ->updateStateUsing(function (Model $record, $state): void {
                        Article::where('unique_id', $record->unique_id)
                               ->update([
                                'is_published' => $state,
                                'published_at' => $state ? now():null
                            ]);
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
            'index' => Pages\ListArticles::route('/'),
            'create' => Pages\CreateArticle::route('/create'),
            'edit' => Pages\EditArticle::route('/{record}/edit'),
        ];
    }
}
