<?php

namespace App\Filament\Resources\Branches\Pages;

use App\Filament\Resources\Branches\BranchResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListBranches extends ListRecords
{
    protected static string $resource = BranchResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\ImportAction::make()
                ->importer(\App\Filament\Imports\BranchImporter::class),
            \Filament\Actions\ExportAction::make()
                ->exporter(\App\Filament\Exports\BranchExporter::class),
            CreateAction::make(),
        ];
    }
}
