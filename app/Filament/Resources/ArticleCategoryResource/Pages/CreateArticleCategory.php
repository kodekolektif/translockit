<?php

namespace App\Filament\Resources\ArticleCategoryResource\Pages;

use App\Filament\Resources\ArticleCategoryResource;
use App\Models\ArticleCategory;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class CreateArticleCategory extends CreateRecord
{
    protected static string $resource = ArticleCategoryResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        return DB::transaction(function () use ($data) {
            $uniqueId = Str::uuid()->toString();

            $primaryRecord = null;

            foreach (['en', 'es'] as $lang) {
                $faq = ArticleCategory::create([
                    'lang'        => $lang,
                    'unique_id'   => $uniqueId,
                    'name'    => $data['name'][$lang],
                ]);

                if (is_null($primaryRecord)) {
                    $primaryRecord = $faq;
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
            ->body('Article Category entries for both English and Spanish have been created successfully.');
    }
}
