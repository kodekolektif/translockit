<?php

namespace App\Filament\Resources\TestimonialsResource\Pages;

use App\Filament\Resources\TestimonialsResource;
use App\Models\Testimonial;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class CreateTestimonials extends CreateRecord
{

    protected static string $resource = TestimonialsResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        return DB::transaction(function () use ($data) {
            $uniqueId = Str::uuid()->toString();

            $primaryRecord = null;

            foreach (['en', 'es'] as $lang) {
                $testimonial = Testimonial::create([
                    'lang'        => $lang,
                    'unique_id'   => $uniqueId,
                    'name'        => $data['name'][$lang] ?? null,
                    'title'       => $data['title'][$lang] ?? null,
                    'content'     => $data['content'][$lang] ?? null,
                    'image'       => $data['image'][$lang] ?? null,
                    'is_active'   => $data['is_active'] ?? true,
                ]);

                if (is_null($primaryRecord)) {
                    $primaryRecord = $testimonial;
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
            ->title('Testiminial Created')
            ->body('Testiminial entries for both English and Spanish have been created successfully.');
    }
}
