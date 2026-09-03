<?php

namespace App\Filament\Resources\MsOffices\Pages;

use App\Filament\Resources\MsOffices\MsOfficeResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditMsOffice extends EditRecord
{
    protected static string $resource = MsOfficeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
