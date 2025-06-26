<?php

namespace App\Filament\Resources\SoftwareResource\Pages;

use App\Filament\Resources\SoftwareResource;
use App\Models\Product;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;


class CreateSoftware extends CreateRecord
{
    protected static string $resource = SoftwareResource::class;

     protected function handleRecordCreation(array $data): Model
    {
        return DB::transaction(function () use ($data) {
            $uniqueId = Str::uuid()->toString();

            $logoPath = $data['logo'] ?? null;
            if (isset($data['logo']) && $data['logo'] instanceof TemporaryUploadedFile) {
                // 1. Simpan file seperti biasa, ini akan mengembalikan 'product-logos/namafile.png'
                $fullPath = $data['logo']->store('product', 'public');

                // 2. Ambil HANYA nama filenya saja dari path lengkap tersebut
                $logoPath = basename($fullPath); // Hasilnya: 'namafile.png'
            }

            $slug = Str::slug($data['name']['en'] ?? 'default-name', '-');

            $primaryRecord = null;

            foreach (['en', 'es'] as $lang) {
                $service = Product::create([
                    'lang'        => $lang,
                    'unique_id'   => $uniqueId,
                    'logo'        => $logoPath,
                    'slug'        => $slug . ($lang === 'es' ? '-es' : ''), // Append '-es' for Spanish
                    'name'       => $data['name'] ?? null,
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
            ->title('Created')
            ->body('Product entries for both English and Spanish have been created successfully.');
    }
}
