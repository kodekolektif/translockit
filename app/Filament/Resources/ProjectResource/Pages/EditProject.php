<?php

namespace App\Filament\Resources\ProjectResource\Pages;

use App\Filament\Resources\ProjectResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class EditProject extends EditRecord
{
    protected static string $resource = ProjectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
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
            'image' => $recordModel->image,
            'is_active' => $recordModel->is_active,
            'service_id' => $recordModel->service_id,
            'name' => [
                'en' => $recordModel->name ?? '',
                'es' => $sibling?->name ?? '',
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
                    Storage::disk('public')->delete('project/' . $record->image);
                }
                $fullPath = $data['image']->store('project', 'public');
                $imageFileName = basename($fullPath);
            }

            // Update record utama (EN)
            $record->update([
                'image' => $imageFileName,
                'is_active' => $data['is_active'],
                'name' => $data['name']['en'],
                'description' => $data['description']['en'],
            ]);

            // Update record sibling (ES)
            if ($sibling) {
                $sibling->update([
                    'image' => $imageFileName, // Gunakan path ikon yang sama
                    'is_active' => $data['is_active'], // Gunakan status aktif yang sama
                    'name' => $data['name']['es'],
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
