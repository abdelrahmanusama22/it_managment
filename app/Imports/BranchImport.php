<?php

namespace App\Imports;

use App\Models\Branch;
use App\Models\Company;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BranchImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $companyName = $row['company'] ?? null;
        $company = $companyName ? Company::firstOrCreate(['name' => $companyName]) : null;

        return new Branch([
            'company_id' => $company?->id,
            'name'       => $row['name'] ?? null,
            'address'    => $row['address'] ?? null,
        ]);
    }
}
