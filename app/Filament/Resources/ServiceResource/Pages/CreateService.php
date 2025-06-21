<?php

namespace App\Filament\Resources\ServiceResource\Pages;

use App\Filament\Resources\ServiceResource;
use App\Models\Service;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class CreateService extends CreateRecord
{
    protected static string $resource = ServiceResource::class;

    /**
     * Override the default creation logic to handle multiple records.
     */
    protected function handleRecordCreation(array $data): Model
    {
        return DB::transaction(function () use ($data) {
            $uniqueId = Str::uuid()->toString();

            $iconPath = $data['icon'] ?? null;
            if (isset($data['icon']) && $data['icon'] instanceof TemporaryUploadedFile) {
                // 1. Simpan file seperti biasa, ini akan mengembalikan 'service-icons/namafile.png'
                $fullPath = $data['icon']->store('service-icons', 'public');

                // 2. Ambil HANYA nama filenya saja dari path lengkap tersebut
                $iconPath = basename($fullPath); // Hasilnya: 'namafile.png'
            }

            $primaryRecord = null;

            foreach (['en', 'es'] as $lang) {
                $service = Service::create([
                    'lang'        => $lang,
                    'unique_id'   => $uniqueId,
                    'icon'        => $iconPath,
                    'title'       => $data['title'][$lang] ?? null,
                    'description' => $data['description'][$lang] ?? null,
                    'is_active'   => $data['is_active'] ?? true,
                ]);

                if (is_null($primaryRecord)) {
                    $primaryRecord = $service;
                }
            }

            return $primaryRecord;
        });
    }

    /**
     * ✅ ADD THIS METHOD TO REDIRECT TO THE TABLE
     *
     * @return string The URL to redirect to after creation.
     */
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    /**
     * Customize the success notification.
     */
    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Services Created')
            ->body('Service entries for both English and Spanish have been created successfully.');
    }
}
