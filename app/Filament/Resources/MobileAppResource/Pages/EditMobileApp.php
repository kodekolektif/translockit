<?php

namespace App\Filament\Resources\MobileAppResource\Pages;

use App\Filament\Resources\MobileAppResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMobileApp extends EditRecord
{
    protected static string $resource = MobileAppResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
