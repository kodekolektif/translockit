<?php

namespace App\Filament\Resources\MobileListResource\Pages;

use App\Filament\Resources\MobileListResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
class EditMobileList extends EditRecord
{
    protected static string $resource = MobileListResource::class;

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
                'logo' => $recordModel->logo,
                'is_active' => $recordModel->is_active,
                'title' => [
                    'en' => $recordModel->title ?? '',
                    'es' => $sibling?->title ?? '',
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
            $logoFileName = $record->logo;

            // ✅ MODIFIED LOGIC HERE
            // Check if a NEW logo file was actually uploaded
            if (isset($data['logo']) && $data['logo'] instanceof TemporaryUploadedFile) {
                // A new file was uploaded, process it
                if ($record->logo) {
                    // Delete the old logo using its full path
                    Storage::disk('public')->delete('mobile-list/' . $record->logo);
                }
                $fullPath = $data['logo']->store('mobile-list', 'public');
                $logoFileName = basename($fullPath);
            } else if (isset($data['logo']) && is_string($data['logo'])) {
                $logoFileName = $data['logo'];
            } else {
                $logoFileName = null; // Or an empty string, depending on your database schema
            }

            // Ensure you import the TemporaryUploadedFile class if you haven't already:
            // use Livewire\Features\SupportFileUploads\TemporaryUploadedFile; // Or Filament's specific namespace if different

            // Update main record (EN)
            $record->update([
                'logo' => $logoFileName, // This will now be the new file, existing file, or null
                'is_active' => $data['is_active'],
                'title' => $data['title']['en'],
            ]);

            // Update sibling record (ES)
            if ($sibling) {
                $sibling->update([
                    'logo' => $logoFileName, // Use the same logo path
                    'is_active' => $data['is_active'], // Use the same active status
                    'title' => $data['title']['es'],
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
