<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FAQResource\Pages;
use App\Filament\Resources\FAQResource\RelationManagers;
use App\Models\Faq;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FAQResource extends Resource
{
    protected static ?string $model = Faq::class;

    protected static ?string $navigationIcon = 'heroicon-o-question-mark-circle';
    protected static ?string $navigationGroup = 'Content Management';
    protected static ?int $navigationSort = 11;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('English (EN)')
                    ->collapsible()
                    ->schema([
                        Forms\Components\TextInput::make('question.en')
                            ->label('Question (EN)')
                            ->columnSpanFull()
                            ->required()
                        ->maxLength(255),
                    Forms\Components\RichEditor::make('answer.en')
                        ->label('Answer (EN)')
                        ->columnSpanFull()
                        ->required(),
                ]),
                Forms\Components\Actions::make([
                    Forms\Components\Actions\Action::make('Make Spanish Translation')
                        ->action(function (Forms\Get $get, Forms\Set $set) {
                            $questionEn = $get('question.en');
                            $answerEn = $get('answer.en');

                            // Call your Gemini class
                            $translator = new \App\Libs\GeminiAI(app(\App\Settings\AppSettings::class));
                            $questionEs = $translator->translate($questionEn, 'es');
                            $answerEs = $translator->translate($answerEn, 'es');

                            // Set translated fields
                            $set('question.es', $questionEs);
                            $set('answer.es', $answerEs);
                        })
                        ->icon('heroicon-o-language'),
                ]),
                Section::make('Spanish (ES)')
                    ->collapsible()
                    ->schema([
                        Forms\Components\TextInput::make('question.es')
                            ->label('Question (ES)')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\RichEditor::make('answer.es')
                            ->label('Answer (ES)')
                            ->required(),
                ]),
                Forms\Components\Toggle::make('is_active')
                    ->default(true)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function (Builder $query) {
                $query->where('lang', 'en')->with('sibling');
            })
            ->columns([
               TextColumn::make('question')
               ->label('Question'),
               TextColumn::make('answer')
               ->html()
               ->limit(100)
               ->label('Answer'),
               Tables\Columns\ToggleColumn::make('is_active')
                    ->label('Active'),
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
            'index' => Pages\ListFAQS::route('/'),
            'create' => Pages\CreateFAQ::route('/create'),
            'edit' => Pages\EditFAQ::route('/{record}/edit'),
        ];
    }
}
