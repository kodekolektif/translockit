<?php

namespace App\Filament\Resources\AuthorResource\Pages;

use App\Filament\Resources\AuthorResource;
use App\Models\Author;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class CreateAuthor extends CreateRecord
{
    protected static string $resource = AuthorResource::class;

    protected function handleRecordCreation(array $data): Model
    {

        return DB::transaction(function () use ($data) {
            $uniqueId = Str::uuid()->toString();

            $profilePath = $data['profile'] ?? null;
            if (isset($data['profile']) && $data['profile'] instanceof TemporaryUploadedFile) {
                // 1. Simpan file seperti biasa, ini akan mengembalikan 'service-profiles/namafile.png'
                $fullPath = $data['profile']->store('profile', 'public');

                // 2. Ambil HANYA nama filenya saja dari path lengkap tersebut
                $profilePath = basename($fullPath); // Hasilnya: 'namafile.png'
            }

            $primaryRecord = null;

            foreach (['en', 'es'] as $lang) {
                // If the language data is not provided, skip to the next iteration
                if (!isset($data['title'][$lang]) || !isset($data['description'][$lang])) {
                    continue;
                }
                $author = Author::create([
                    'lang'        => $lang,
                    'unique_id'   => $uniqueId,
                    'profile'      => $profilePath,
                    'name'        => $data['name'],
                    'title'       => $data['title'][$lang],
                    'description' => $data['description'][$lang],
                    'social_instagram'  => $data['social_instagram'] ?? null,
                    'social_linkedin'   => $data['social_linkedin']??null,
                    'social_facebook'   => $data['social_facebook'] ?? null,
                    'social_twitter'   => $data['social_twitter'] ?? null,
                ]);

                if (is_null($primaryRecord)) {
                    $primaryRecord = $author;
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
            ->title('Author Created')
            ->body('Autor entries for both English and Spanish have been created successfully.');
    }
}
