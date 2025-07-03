<?php

namespace App\Filament\Resources\FAQResource\Pages;

use App\Filament\Resources\FAQResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Container\Attributes\Storage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class EditFAQ extends EditRecord
{
    protected static string $resource = FAQResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()->before(function ($action, Model $record) {
                // Hapus record sibling (ES) sebelum record utama (EN) dihapus
                $record->sibling()->delete();
            }),
        ];
    }
    public function mount(int | string $record): void
    {
        parent::mount($record);

        $recordModel = $this->getRecord();
        $sibling = $recordModel->sibling()->first();

        $formData = [
            'is_active' => $recordModel->is_active,
            'question' => [
                'en' => $recordModel->question ?? '',
                'es' => $sibling?->question ?? '',
            ],
            'answer' => [
                'en' => $recordModel->answer ?? '',
                'es' => $sibling?->answer ?? '',
            ],
        ];

        $this->form->fill($formData);
    }
    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        return DB::transaction(function () use ($record, $data) {
            $sibling = $record->sibling()->first();

            // Update record utama (EN)
            $record->update([
                'is_active' => $data['is_active'],
                'question' => $data['question']['en'],
                'answer' => $data['answer']['en'],
            ]);

            // Update record sibling (ES)
            if ($sibling) {
                $sibling->update([
                    'is_active' => $data['is_active'], // Gunakan status aktif yang sama
                    'question' => $data['question']['es'],
                    'answer' => $data['answer']['es'],
                ]);
            }

            return $record;
        });
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }


}
