<?php

namespace App\Filament\Resources\DeviceTypes\Pages;

use App\Filament\Resources\DeviceTypes\DeviceTypeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListDeviceTypes extends ListRecords
{
    protected static string $resource = DeviceTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\ImportAction::make()
                ->importer(\App\Filament\Imports\DeviceTypeImporter::class),
            \Filament\Actions\ExportAction::make()
                ->exporter(\App\Filament\Exports\DeviceTypeExporter::class),
            CreateAction::make(),
        ];
    }
}
