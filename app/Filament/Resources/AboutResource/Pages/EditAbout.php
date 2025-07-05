<?php

namespace App\Filament\Resources\AboutResource\Pages;

use App\Filament\Resources\AboutResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class EditAbout extends EditRecord
{
    protected static string $resource = AboutResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    public function mount(int | string $record): void
    {
        parent::mount($record);

        $recordModel = $this->getRecord();
        $sibling = $recordModel->sibling()->first();

        $formData = [
            'image' => $recordModel->image,
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
            $imageFileName = $record->image; // Default ke nama file yang sudah ada

            // ✅ LOGIKA BARU DI SINI
            if (isset($data['image']) && $data['image'] instanceof TemporaryUploadedFile) {
                if ($record->image) {
                    // Hapus ikon lama menggunakan path lengkap
                    Storage::disk('public')->delete('about-images/' . $record->image);
                }
                $fullPath = $data['image']->store('about-images', 'public');
                $imageFileName = basename($fullPath);
            } else if (isset($data['image']) && is_string($data['image'])) {
                $imageFileName = $data['image'];
            } else {
                $imageFileName = $record->image; // Or an empty string, depending on your database schema
            }

            // Update record utama (EN)
            $record->update([
                'image' => $imageFileName,
                'is_active' => $data['is_active'],
                'title' => $data['title']['en'],
                'description' => $data['description']['en'],
            ]);

            // Update record sibling (ES)
            if ($sibling) {
                $sibling->update([
                    'image' => $imageFileName, // Gunakan path ikon yang sama
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
