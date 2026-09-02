<?php

namespace App\Imports;

use App\Models\Device;
use App\Models\Company;
use App\Models\Branch;
use App\Models\DeviceType;
use App\Models\Employee;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DeviceImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $companyName = $row['company'] ?? null;
        $branchName = $row['branch'] ?? null;
        $deviceTypeName = $row['device_type'] ?? null;
        $employeeName = $row['employee'] ?? null;

        $company = $companyName ? Company::firstOrCreate(['name' => $companyName]) : null;
        
        $branch = null;
        if ($branchName) {
            $branch = Branch::firstOrCreate(
                ['name' => $branchName],
                ['company_id' => $company?->id ?? \App\Models\Company::firstOrCreate(['name' => 'Default Company'])->id]
            );
        }

        $deviceType = $deviceTypeName ? DeviceType::firstOrCreate(['name' => $deviceTypeName]) : null;
        
        $employee = null;
        if ($employeeName) {
            $employee = Employee::firstOrCreate(
                ['name' => $employeeName],
                ['branch_id' => $branch?->id ?? Branch::firstOrCreate(['name' => 'Default Branch'], ['company_id' => \App\Models\Company::firstOrCreate(['name' => 'Default Company'])->id])->id]
            );
        }

        return new Device([
            'branch_id' => $branch?->id,
            'device_type_id' => $deviceType?->id,
            'employee_id' => $employee?->id,
            'ip_address' => $row['ip_address'] ?? null,
            'mac_address' => $row['mac_address'] ?? null,
            'manufacturer' => $row['manufacturer'] ?? null,
            'model' => $row['model'] ?? null,
            'device_name' => $row['device_name'] ?? null,
            'cpu' => $row['cpu'] ?? null,
            'ram' => $row['ram'] ?? null,
            'ram_speed' => $row['ram_speed'] ?? null,
            'hard_disk' => $row['hard_disk'] ?? null,
            'monitor' => $row['monitor'] ?? null,
            'os_name' => $row['os_name'] ?? null,
            'os_installation_date' => $row['os_installation_date'] ?? null,
            'ms_office_name' => $row['ms_office_name'] ?? null,
            'location_within_branch' => $row['location_within_branch'] ?? null,
            'username' => $row['username'] ?? null,
            'password' => $row['password'] ?? null,
        ]);
    }
}
