<?php

namespace App\Imports;

use App\Models\Employee;
use App\Models\Branch;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class EmployeeImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $branchName = $row['branch'] ?? null;
        $branch = $branchName ? Branch::firstOrCreate(['name' => $branchName], ['company_id' => \App\Models\Company::firstOrCreate(['name' => 'Default Company'])->id]) : null;

        return new Employee([
            'branch_id' => $branch?->id,
            'name'      => $row['name'] ?? null,
        ]);
    }
}
