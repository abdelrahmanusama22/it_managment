<?php

namespace App\Filament\Imports;

use App\Models\Branch;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;
use Illuminate\Support\Number;

class BranchImporter extends Importer
{
    protected static ?string $model = Branch::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('company')
                ->requiredMapping()
                ->relationship(resolveUsing: 'name'),
            ImportColumn::make('name')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('address')
                ->rules(['max:255']),
        ];
    }

    public function resolveRecord(): ?Branch
    {
        $name = $this->data['name'] ?? null;
        $companyName = $this->data['company'] ?? null;

        if ($name && $companyName) {
            $company = \App\Models\Company::firstOrCreate(['name' => $companyName]);
            return Branch::firstOrNew([
                'name' => $name,
                'company_id' => $company->id,
            ]);
        }

        return new Branch();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your branch import has completed and ' . Number::format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . Number::format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
