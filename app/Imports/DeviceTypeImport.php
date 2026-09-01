<?php

namespace App\Imports;

use App\Models\DeviceType;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DeviceTypeImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new DeviceType([
            'name' => $row['name'] ?? null,
        ]);
    }
}
