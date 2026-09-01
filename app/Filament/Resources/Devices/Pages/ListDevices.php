<?php

namespace App\Filament\Resources\Devices\Pages;

use App\Filament\Resources\Devices\DeviceResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListDevices extends ListRecords
{
    protected static string $resource = DeviceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\ImportAction::make()
                ->importer(\App\Filament\Imports\DeviceImporter::class),
            \Filament\Actions\ExportAction::make()
                ->exporter(\App\Filament\Exports\DeviceExporter::class),
            CreateAction::make(),
        ];
    }
}
