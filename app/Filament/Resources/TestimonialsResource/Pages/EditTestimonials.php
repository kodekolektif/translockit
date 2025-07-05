<?php

namespace App\Filament\Resources\TestimonialsResource\Pages;

use App\Filament\Resources\TestimonialsResource;
use Filament\Actions;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Section;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class EditTestimonials extends EditRecord
{
    protected static string $resource = TestimonialsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()->before(function ($action, Model $record) {
                // Hapus record sibling (ES) sebelum record utama (EN) dihapus
                $record->sibling()->delete();
                // Hapus file ikon jika ada
                if ($record->icon) {
                    Storage::disk('public')->delete($record->icon);
                }
            }),
        ];
    }


    public function form(Form $form): Form
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

    public function mount(int | string $record): void
    {
        parent::mount($record);

        $recordModel = $this->getRecord();
        $sibling = $recordModel->sibling()->first();
        $formData = [
            'is_active' => $recordModel->is_active,
            'name' => [
                'en' => $recordModel->name,
                'es' => $sibling?->name,
            ],
            'title' => [
                'en' => $recordModel->title,
                'es' => $sibling?->title,
            ],
            'content' => [
                'en' => $recordModel->content,
                'es' => $sibling?->content,
            ],
            // 'image' => [
            //     'en' => $recordModel->image,
            //     'es' => $sibling?->image,
            // ],
        ];

        $this->form->fill($formData);
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
{
    // Ambil status form terbaru, yang berisi nama file baru jika ada upload.
    $formState = $this->form->getState();

    return DB::transaction(function () use ($record, $data, $formState) {

        // --- Ambil NAMA FILE ASLI dari database sebelum ada perubahan ---
        $originalEnImageName = $record->getRawOriginal('image');
        $sibling = $record->sibling()->first();
        $originalEsImageName = $sibling ? $sibling->getRawOriginal('image') : null;

        // --- Siapkan variabel final, defaultnya adalah nama file yang lama ---
        $finalEnImageName = $originalEnImageName;
        $finalEsImageName = $originalEsImageName;

        // --- Proses Gambar EN ---
        // Ambil nama file dari state form. Bisa jadi nama lama atau nama baru.
        $newStateEnImage = $formState['image']['en'] ?? null;

        // Jika nama file di state form BERBEDA dengan nama file asli di DB, berarti ada upload baru.
        if ($newStateEnImage && $newStateEnImage !== $originalEnImageName) {
            // Hapus file lama jika ada.
            if ($originalEnImageName) {
                Storage::disk('public')->delete('testimonials/' . $originalEnImageName);
            }
            // Nama file baru sudah ada di $newStateEnImage, kita tinggal pakai.
            $finalEnImageName = $newStateEnImage;
        }

        // --- Proses Gambar ES ---
        if ($sibling) {
            $newStateEsImage = $formState['image']['es'] ?? null;
            // Jika nama file di state form BERBEDA dengan nama file asli di DB, berarti ada upload baru.
            if ($newStateEsImage && $newStateEsImage !== $originalEsImageName) {
                if ($originalEsImageName) {
                    Storage::disk('public')->delete('testimonials/' . $originalEsImageName);
                }
                $finalEsImageName = $newStateEsImage;
            }
        }

        // --- Update Database ---
        // Untuk data non-file, kita tetap gunakan $data karena sudah tervalidasi.
        $record->update([
            'image' => $finalEnImageName,
            'is_active' => $data['is_active'],
            'name' => $data['name']['en'],
            'title' => $data['title']['en'],
            'content' => $data['content']['en'],
        ]);

        if ($sibling) {
            $sibling->update([
                'image' => $finalEsImageName,
                'is_active' => $data['is_active'],
                'name' => $data['name']['es'],
                'title' => $data['title']['es'],
                'content' => $data['content']['es'],
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
