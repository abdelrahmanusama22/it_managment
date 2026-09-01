<?php

namespace App\Filament\Imports;

use App\Models\Employee;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;
use Illuminate\Support\Number;

class EmployeeImporter extends Importer
{
    protected static ?string $model = Employee::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('branch')
                ->requiredMapping()
                ->relationship(resolveUsing: 'name'),
            ImportColumn::make('name')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
        ];
    }

    public function resolveRecord(): ?Employee
    {
        $name = $this->data['name'] ?? null;
        $branchName = $this->data['branch'] ?? null;

        if ($name && $branchName) {
            $branch = \App\Models\Branch::firstOrCreate(
                ['name' => $branchName],
                ['company_id' => \App\Models\Company::firstOrCreate(['name' => 'Default Company'])->id]
            );
            return Employee::firstOrNew([
                'name' => $name,
                'branch_id' => $branch->id,
            ]);
        }

        return new Employee();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your employee import has completed and ' . Number::format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . Number::format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
