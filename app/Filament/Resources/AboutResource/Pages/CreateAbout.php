<?php

namespace App\Filament\Resources\AboutResource\Pages;

use App\Filament\Resources\AboutResource;
use App\Models\About;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class CreateAbout extends CreateRecord
{
    protected static string $resource = AboutResource::class;
    protected function handleRecordCreation(array $data): Model
    {
        return DB::transaction(function () use ($data) {
            $uniqueId = Str::uuid()->toString();

            $imagePath = $data['image'] ?? null;
            if (isset($data['image']) && $data['image'] instanceof TemporaryUploadedFile) {
                // 1. Simpan file seperti biasa, ini akan mengembalikan 'service-images/namafile.png'
                $fullPath = $data['image']->store('service-images', 'public');

                // 2. Ambil HANYA nama filenya saja dari path lengkap tersebut
                $imagePath = basename($fullPath); // Hasilnya: 'namafile.png'
            }

            $primaryRecord = null;

            foreach (['en', 'es'] as $lang) {
                // If the language data is not provided, skip to the next iteration
                if (!isset($data['title'][$lang]) || !isset($data['description'][$lang])) {
                    continue;
                }
                $service = About::create([
                    'lang'        => $lang,
                    'unique_id'   => $uniqueId,
                    'image'        => $imagePath,
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
            ->title('About Created')
            ->body('About entries for both English and Spanish have been created successfully.');
    }
}
