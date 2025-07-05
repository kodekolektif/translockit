<?php

namespace App\Filament\Resources\ServiceResource\Pages;

use App\Filament\Resources\ServiceResource;
use Filament\Actions;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class EditService extends EditRecord
{
    protected static string $resource = ServiceResource::class;

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

    /**
     * Mendefinisikan struktur form.
     */
    public function form(Form $form): Form
    {
        // Kode form Anda sebagian besar sudah benar, kita letakkan di sini.
        return $form
            ->schema([
                Forms\Components\FileUpload::make('icon')
                    ->label('Icon')
                    ->image()
                    ->disk('public')
                    ->nullable() // Pada edit, ikon mungkin sudah ada
                    ->columnSpanFull(),

                Forms\Components\Section::make('English (EN)')
                    ->collapsible()
                    ->schema([
                        Forms\Components\TextInput::make('title.en')
                            ->label('Title (EN)')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Textarea::make('description.en') // Gunakan Textarea untuk deskripsi panjang
                            ->label('Description (EN)')
                            ->required()
                            ->maxLength(1000), // Beri lebih banyak ruang
                    ]),

                // Tombol Aksi untuk translasi
                Forms\Components\Actions::make([
                    Forms\Components\Actions\Action::make('Make Spanish Translation')
                        ->action(function (Forms\Get $get, Forms\Set $set) {
                            $titleEn = $get('title.en');
                            $descriptionEn = $get('description.en');

                            try {
                                $translator = new \App\Libs\GeminiAI(app(\App\Settings\AppSettings::class));
                                $titleEs = $translator->translate($titleEn, 'es');
                                $descriptionEs = $translator->translate($descriptionEn, 'es');
                                $set('title.es', $titleEs);
                                $set('description.es', $descriptionEs);
                            } catch (\Exception $e) {
                                // Handle error jika API gagal
                                \Filament\Notifications\Notification::make()
                                    ->title('Translation Failed')
                                    ->body($e->getMessage())
                                    ->danger()
                                    ->send();
                            }
                        })
                        ->icon('heroicon-o-language'),
                ])->columnSpanFull(),

                Forms\Components\Section::make('Spanish (ES)')
                    ->collapsible()
                    ->schema([
                        Forms\Components\TextInput::make('title.es')
                            ->label('Title (ES)')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Textarea::make('description.es') // Gunakan Textarea
                            ->label('Description (ES)')
                            ->required()
                            ->maxLength(1000),
                    ]),

                Forms\Components\Toggle::make('is_active')
                    ->label('Is Active')
                    ->default(true)
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
            'icon' => $recordModel->icon,
            'is_active' => $recordModel->is_active,
            'title' => [
                'en' => $recordModel->title ?? '',
                'es' => $sibling?->title ?? '',
            ],
            'description' => [
                'en' => $recordModel->description ?? '',
                'es' => $sibling?->description ?? '',
            ],
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
            $iconFileName = $record->icon; // Default ke nama file yang sudah ada

            // ✅ LOGIKA BARU DI SINI
            if (isset($data['icon']) && $data['icon'] instanceof TemporaryUploadedFile) {
                if ($record->icon) {
                    // Hapus ikon lama menggunakan path lengkap
                    Storage::disk('public')->delete('service-icons/' . $record->icon);
                }
                $fullPath = $data['icon']->store('service-icons', 'public');
                $iconFileName = basename($fullPath);
            } else if (isset($data['icon']) && is_string($data['icon'])) {
                $iconFileName = $data['icon'];
            } else {
                $iconFileName = $record->logo; // Or an empty string, depending on your database schema
            }

            // Update record utama (EN)
            $record->update([
                'icon' => $iconFileName,
                'is_active' => $data['is_active'],
                'title' => $data['title']['en'],
                'description' => $data['description']['en'],
            ]);

            // Update record sibling (ES)
            if ($sibling) {
                $sibling->update([
                    'icon' => $iconFileName, // Gunakan path ikon yang sama
                    'is_active' => $data['is_active'], // Gunakan status aktif yang sama
                    'title' => $data['title']['es'],
                    'description' => $data['description']['es'],
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
