<?php

namespace App\Filament\Resources\Devices\Pages;

use App\Filament\Resources\Devices\DeviceResource;
use App\Filament\Actions\CustomImportAction;
use App\Filament\Imports\DeviceImporter;
use Filament\Actions\CreateAction;
use Filament\Actions\ExportAction;
use App\Filament\Exports\DeviceExporter;
use Filament\Resources\Pages\ListRecords;

class ListDevices extends ListRecords
{
    protected static string $resource = DeviceResource::class;

    protected function getHeaderActions(): array
    {
        dd('File is being read from server!');
        return [
            CustomImportAction::make()
                ->importer(DeviceImporter::class),
            ExportAction::make()
                ->exporter(DeviceExporter::class),
            CreateAction::make(),
        ];
    }
}
