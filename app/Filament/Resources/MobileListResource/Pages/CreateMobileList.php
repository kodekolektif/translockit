<?php

namespace App\Filament\Resources\MobileListResource\Pages;

use App\Filament\Resources\MobileListResource;
use App\Models\MobileList;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class CreateMobileList extends CreateRecord
{
    protected static string $resource = MobileListResource::class;

     protected function handleRecordCreation(array $data): Model
    {
        return DB::transaction(function () use ($data) {
            $uniqueId = Str::uuid()->toString();

            $logoPath = $data['logo'] ?? null;
            if (isset($data['logo']) && $data['logo'] instanceof TemporaryUploadedFile) {
                // 1. Simpan file seperti biasa, ini akan mengembalikan 'mobile-app/namafile.png'
                $fullPath = $data['logo']->store('mobile-app', 'public');

                // 2. Ambil HANYA nama filenya saja dari path lengkap tersebut
                $logoPath = basename($fullPath); // Hasilnya: 'namafile.png'
            }

            $primaryRecord = null;

            foreach (['en', 'es'] as $lang) {
                $service = MobileList::create([
                    'lang'        => $lang,
                    'unique_id'   => $uniqueId,
                    'logo'        => $logoPath,
                    'title'       => $data['title'][$lang] ?? null,
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
            ->title('Mobile App Created')
            ->body('Mobile App entries for both English and Spanish have been created successfully.');
    }
}
