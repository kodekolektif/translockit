<?php

namespace App\Filament\Resources\ArticleResource\Pages;

use App\Filament\Resources\ArticleResource;
use App\Models\Article;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class CreateArticle extends CreateRecord
{
    protected static string $resource = ArticleResource::class;

    protected function handleRecordCreation(array $data): Model
    {

        return DB::transaction(function () use ($data) {
            $uniqueId = Str::uuid()->toString();

            $thumbnailPath = $data['thumbnail'] ?? null;
            if (isset($data['thumbnail']) && $data['thumbnail'] instanceof TemporaryUploadedFile) {
                // 1. Simpan file seperti biasa, ini akan mengembalikan 'service-thumbnails/namafile.png'
                $fullPath = $data['thumbnail']->store('thumbnails', 'public');

                // 2. Ambil HANYA nama filenya saja dari path lengkap tersebut
                $thumbnailPath = basename($fullPath); // Hasilnya: 'namafile.png'
            }

            $primaryRecord = null;

            foreach (['en', 'es'] as $lang) {
                // If the language data is not provided, skip to the next iteration
                if (!isset($data['title'][$lang]) || !isset($data['content'][$lang])) {
                    continue;
                }
                $article = Article::create([
                    'lang'        => $lang,
                    'unique_id'   => $uniqueId,
                    'slug'        => Str::slug($data['title'][$lang] ?? '', '-'),
                    'thumbnail'   => $thumbnailPath,
                    'title'       => $data['title'][$lang],
                    'content'     => $data['content'][$lang],
                    'is_published'=> $data['is_published'] ?? false,
                    'category'    => $data['category']??null,
                    'tags'        => $data['tags'] ?? [],
                    'views'       => 0, // Default value
                    'likes'       => 0, // Default value
                    'published_at'=> $data['is_published'] ? now() : null,
                    'category_id' => $data['category_id']??null,
                 ]);

                if (is_null($primaryRecord)) {
                    $primaryRecord = $article;
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
