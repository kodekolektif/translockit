<?php

namespace App\Filament\Resources\MobileListResource\Pages;

use App\Filament\Resources\MobileListResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMobileLists extends ListRecords
{
    protected static string $resource = MobileListResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
