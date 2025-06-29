<?php

namespace App\Filament\Resources\ProjectResource\Pages;

use App\Filament\Resources\ProjectResource;
use App\Models\Project;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class CreateProject extends CreateRecord
{
    protected static string $resource = ProjectResource::class;

     /**
     * Override the default creation logic to handle multiple records.
     */
    protected function handleRecordCreation(array $data): Model
    {
        return DB::transaction(function () use ($data) {
            $uniqueId = Str::uuid()->toString();

            $imagePath = $data['image'] ?? null;
            if (isset($data['image']) && $data['image'] instanceof TemporaryUploadedFile) {
                // 1. Simpan file seperti biasa, ini akan mengembalikan 'project-images/namafile.png'
                $fullPath = $data['image']->store('project-images', 'public');

                // 2. Ambil HANYA nama filenya saja dari path lengkap tersebut
                $imagePath = basename($fullPath); // Hasilnya: 'namafile.png'
            }

            $primaryRecord = null;

            foreach (['en', 'es'] as $lang) {
                // If the language data is not provided, skip to the next iteration
                if (!isset($data['name'][$lang]) || !isset($data['description'][$lang])) {
                    continue;
                }
                $service = Project::create([
                    'name'        => $data['name'][$lang] ?? null,
                    'lang'        => $lang,
                    'unique_id'   => $uniqueId,
                    'slug'        => Str::slug($data['name'][$lang].'-'.$lang),
                    'image'       => $imagePath,
                    'service_id'  => $data['service_id'] ?? null,
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
            ->title('Projects Created')
            ->body('Project entries for both English and Spanish have been created successfully.');
    }
}
