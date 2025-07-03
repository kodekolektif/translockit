<?php

namespace App\Filament\Resources\FAQResource\Pages;

use App\Filament\Resources\FAQResource;
use App\Models\Faq;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CreateFAQ extends CreateRecord
{
    protected static string $resource = FAQResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        return DB::transaction(function () use ($data) {
            $uniqueId = Str::uuid()->toString();

            $primaryRecord = null;

            foreach (['en', 'es'] as $lang) {
                $faq = Faq::create([
                    'lang'        => $lang,
                    'unique_id'   => $uniqueId,
                    'question'    => $data['question'][$lang],
                    'answer'      => $data['answer'][$lang],
                    'is_active'   => $data['is_active'] ?? true,
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
            ->body('FAQ entries for both English and Spanish have been created successfully.');
    }

}
