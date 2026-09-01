<?php

namespace App\Filament\Imports;

use App\Models\Device;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;
use Illuminate\Support\Number;

class DeviceImporter extends Importer
{
    protected static ?string $model = Device::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('branch')
                ->relationship(resolveUsing: 'name'),
            ImportColumn::make('deviceType')
                ->relationship(resolveUsing: 'name'),
            ImportColumn::make('employee')
                ->relationship(resolveUsing: 'name'),
            ImportColumn::make('logged_on_user')
                ->relationship(name: 'employee', resolveUsing: 'logged_on_user'),
            ImportColumn::make('ip_address')
                ->rules(['nullable', 'max:255']),
            ImportColumn::make('mac_address')
                ->rules(['nullable', 'max:255']),
            ImportColumn::make('manufacturer')
                ->relationship(resolveUsing: 'name'),
            ImportColumn::make('model')
                ->rules(['nullable', 'max:255']),
            ImportColumn::make('device_name')
                ->rules(['nullable', 'max:255']),
            ImportColumn::make('cpu')
                ->rules(['nullable', 'max:255']),
            ImportColumn::make('ram')
                ->rules(['nullable', 'max:255']),
            ImportColumn::make('ram_speed')
                ->rules(['nullable', 'max:255']),
            ImportColumn::make('hard_disk')
                ->rules(['nullable', 'max:255']),
            ImportColumn::make('monitor')
                ->rules(['nullable', 'max:255']),
            ImportColumn::make('os_name')
                ->relationship(name: 'software', resolveUsing: 'os_name'),
            ImportColumn::make('os_installation_date')
                ->rules(['nullable', 'date']),
            ImportColumn::make('location_within_branch')
                ->rules(['nullable', 'max:255']),
            ImportColumn::make('username')
                ->rules(['nullable', 'max:255']),
            ImportColumn::make('password'),
        ];
    }

    public function __invoke(array $data): void
    {
        try {
            parent::__invoke($data);
        } catch (\Throwable $e) {
            throw new \Filament\Actions\Imports\Exceptions\RowImportFailedException($e->getMessage());
        }
    }

    protected function beforeValidate(): void
    {
        // Clean up strings, converting empty strings with spaces to null
        foreach ($this->data as $key => $value) {
            if (is_string($value)) {
                $trimmed = trim($value);
                $this->data[$key] = $trimmed === '' ? null : $trimmed;
            }
        }

        // Auto-create relations if missing so Filament's relationship resolution doesn't fail
        if (!empty($this->data['branch'])) {
            $company = \App\Models\Company::firstOrCreate(['name' => 'Default Company']);
            \App\Models\Branch::firstOrCreate(['name' => $this->data['branch']], ['company_id' => $company->id]);
        }

        if (!empty($this->data['deviceType'])) {
            \App\Models\DeviceType::firstOrCreate(['name' => $this->data['deviceType']]);
        }

        $employeeName = $this->data['employee'] ?? null;
        $loggedOnUser = $this->data['logged_on_user'] ?? null;

        if (!empty($employeeName) || !empty($loggedOnUser)) {
            $company = \App\Models\Company::firstOrCreate(['name' => 'Default Company']);
            $branch = \App\Models\Branch::firstOrCreate(['name' => 'Default Branch'], ['company_id' => $company->id]);

            if (!empty($employeeName)) {
                $employee = \App\Models\Employee::firstOrCreate(
                    ['name' => $employeeName],
                    [
                        'logged_on_user' => $loggedOnUser,
                        'branch_id' => $branch->id,
                    ]
                );

                // Update logged_on_user if it was previously empty but is now provided
                if (!empty($loggedOnUser) && empty($employee->logged_on_user)) {
                    $employee->update(['logged_on_user' => $loggedOnUser]);
                }
            } else {
                \App\Models\Employee::firstOrCreate(
                    ['logged_on_user' => $loggedOnUser],
                    [
                        'name' => 'Unknown',
                        'branch_id' => $branch->id,
                    ]
                );
            }
        }

        if (!empty($this->data['manufacturer'])) {
            \App\Models\Manufacturer::firstOrCreate(['name' => $this->data['manufacturer']]);
        }

        if (!empty($this->data['os_name'])) {
            \App\Models\Software::firstOrCreate(['os_name' => $this->data['os_name']]);
        }

        // Attempt to parse date formats safely, defaulting to null if unparseable
        if (isset($this->data['os_installation_date']) && filled($this->data['os_installation_date'])) {
            try {
                $this->data['os_installation_date'] = \Carbon\Carbon::parse($this->data['os_installation_date'])->format('Y-m-d');
            } catch (\Throwable $e) {
                $this->data['os_installation_date'] = null;
            }
        }
    }

    public function resolveRecord(): ?Device
    {
        $macAddress = $this->data['mac_address'] ?? null;
        $ipAddress = $this->data['ip_address'] ?? null;
        $deviceName = $this->data['device_name'] ?? null;

        if ($macAddress) {
            return Device::firstOrNew(['mac_address' => $macAddress]);
        }

        if ($ipAddress) {
            return Device::firstOrNew(['ip_address' => $ipAddress]);
        }

        if ($deviceName) {
            return Device::firstOrNew(['device_name' => $deviceName]);
        }

        return new Device();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your device import has completed and ' . Number::format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . Number::format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
