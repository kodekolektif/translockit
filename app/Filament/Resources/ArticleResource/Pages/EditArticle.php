<?php

namespace App\Filament\Resources\ArticleResource\Pages;

use App\Filament\Resources\ArticleResource;
use App\Models\ArticleCategory;
use Filament\Actions;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class EditArticle extends EditRecord
{
    protected static string $resource = ArticleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()->before(function ($action, Model $record) {
                // Hapus record sibling (ES) sebelum record utama (EN) dihapus
                $record->sibling()->delete();
                // Hapus file ikon jika ada
                if ($record->thumbnail) {
                    Storage::disk('public')->delete($record->thumbnail);
                }
            }),
        ];
    }
      public function form(Form $form): Form
    {
        // Kode form Anda sebagian besar sudah benar, kita letakkan di sini.
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
                                $translator = new \App\Libs\GeminiAI(app(\App\Settings\AppSettings::class));
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
                    Select::make('category_id')
                        ->label('Category')
                        ->options(ArticleCategory::where('lang','en')->get()->pluck('name','unique_id')),
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

    /**
     * PERBAIKAN 1: Memuat data dari kedua record (EN & ES) ke dalam form.
     */
    public function mount(int | string $record): void
    {
        parent::mount($record);

        $recordModel = $this->getRecord();
        $sibling = $recordModel->sibling()->first();

        $formData = [
            'thumbnail' => $recordModel->thumbnail,
            'title' => [
                'en' => $recordModel->title,
                'es' => $sibling->title
            ],
            'content'=> [
                'en' => $recordModel->content,
                'es' => $sibling->content
            ],
            'tags' => $recordModel->tags,
            'category_id' => $recordModel->category_id,
            'is_published'=> $recordModel->is_published

        ];

        $this->form->fill($formData);
    }

    /**
     * PERBAIKAN 2: Menyimpan data ke kedua record (EN & ES).
     */
    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        return DB::transaction(function () use ($record, $data) {
            $sibling = $record->sibling()->first();
            $thumbnailFileName = $record->thumbnail; // Default ke nama file yang sudah ada

            // ✅ LOGIKA BARU DI SINI
            if (isset($data['thumbnail']) && $data['thumbnail'] instanceof TemporaryUploadedFile) {
                if ($record->thumbnail) {
                    // Hapus ikon lama menggunakan path lengkap
                    Storage::disk('public')->delete('thumbnails/' . $record->thumbnail);
                }
                $fullPath = $data['thumbnail']->store('thumbnails', 'public');
                $thumbnailFileName = basename($fullPath);
            }

            // Update record utama (EN)
            $record->update(attributes: [
                'thumbnail'   => $thumbnailFileName,
                'title'       => $data['title'],
                'content'     => $data['content'],
                'is_published'=> $data['is_published'] ?? false,
                'category_id' => $data['category_id'] ?? null,
            ]);

            // Update record sibling (ES)
            if ($sibling) {
                $sibling->update([
                    'thumbnail'   => $thumbnailFileName,
                    'title'       => $data['title'],
                    'content'     => $data['content'],
                    'is_published'=> $data['is_published'] ?? false,
                    'category_id' => $data['category_id'] ?? null,
                ]);
            }

            return $record;
        });
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
