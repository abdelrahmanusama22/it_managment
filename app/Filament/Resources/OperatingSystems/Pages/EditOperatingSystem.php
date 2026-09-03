<?php

namespace App\Filament\Resources\OperatingSystems\Pages;

use App\Filament\Resources\OperatingSystems\OperatingSystemResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditOperatingSystem extends EditRecord
{
    protected static string $resource = OperatingSystemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
