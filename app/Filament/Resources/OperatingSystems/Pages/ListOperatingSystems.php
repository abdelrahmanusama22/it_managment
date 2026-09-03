<?php

namespace App\Filament\Resources\OperatingSystems\Pages;

use App\Filament\Resources\OperatingSystems\OperatingSystemResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListOperatingSystems extends ListRecords
{
    protected static string $resource = OperatingSystemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
