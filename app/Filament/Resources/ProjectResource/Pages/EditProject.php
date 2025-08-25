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

            // Start with the existing logo filename from the record
            $logoFileName = $record->image;

            // ✅ MODIFIED LOGIC HERE
            // Check if a NEW logo file was actually uploaded
            if (isset($data['image']) && $data['image'] instanceof TemporaryUploadedFile) {
                // A new file was uploaded, process it
                if ($record->logo) {
                    // Delete the old logo using its full path
                    Storage::disk('public')->delete( $record->image);
                }
                $fullPath = $data['image']->store('mobile-list', 'public');
                $logoFileName = basename($fullPath);
            } else if (isset($data['image']) && is_string($data['image'])) {
                $logoFileName = $data['image'];
            } else {
                $logoFileName = null; // Or an empty string, depending on your database schema
            }

            // Update record utama (EN)
            $record->update([
                'image' => $logoFileName,
                'is_active' => $data['is_active'],
                'name' => $data['name']['en'],
                'description' => $data['description']['en'],
            ]);

            // Update record sibling (ES)
            if ($sibling) {
                $sibling->update([
                    'image' => $logoFileName, // Gunakan path ikon yang sama
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
