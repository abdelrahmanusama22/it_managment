<?php

namespace App\Filament\Resources\MsOffices\Pages;

use App\Filament\Resources\MsOffices\MsOfficeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListMsOffices extends ListRecords
{
    protected static string $resource = MsOfficeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
