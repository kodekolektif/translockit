<?php

namespace App\Filament\Resources\SoftwareResource\Pages;

use App\Filament\Resources\SoftwareResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class EditSoftware extends EditRecord
{
    protected static string $resource = SoftwareResource::class;

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
     * PERBAIKAN 1: Memuat data dari kedua record (EN & ES) ke dalam form.
     */
    public function mount(int | string $record): void
    {
        parent::mount($record);

        $recordModel = $this->getRecord();
        $sibling = $recordModel->sibling()->first();

        $formData = [
            'logo' => $recordModel->logo,
            'name' => $recordModel->name,
            'is_active' => $recordModel->is_active,
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
            $logoFileName = $record->logo; // Default ke nama file yang sudah ada

            // ✅ LOGIKA BARU DI SINI
            if (isset($data['logo']) && $data['logo'] instanceof TemporaryUploadedFile) {
                if ($record->logo) {
                    // Hapus ikon lama menggunakan path lengkap
                    Storage::disk('public')->delete('product/' . $record->logo);
                }
                $fullPath = $data['logo']->store('product', 'public');
                $logoFileName = basename($fullPath);
            }

            // Update record utama (EN)
            $record->update([
                'logo' => $logoFileName,
                'is_active' => $data['is_active'],
                'name' => $data['name'],
                'description' => $data['description']['en'],
            ]);

            // Update record sibling (ES)
            if ($sibling) {
                $sibling->update([
                    'logo' => $logoFileName, // Gunakan path ikon yang sama
                    'is_active' => $data['is_active'], // Gunakan status aktif yang sama
                    'name' => $data['name'],
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
