<?php

namespace App\Filament\Exports;

use App\Models\Device;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;
use Illuminate\Support\Str;

class DeviceExporter extends Exporter
{
    protected static ?string $model = Device::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('sku')
                ->label('SKU'),
            ExportColumn::make('company.name')
                ->label('Company Name'),
            ExportColumn::make('branch.name')
                ->label('Branch Name'),
            ExportColumn::make('deviceType.name')
                ->label('Device Type Name'),
            ExportColumn::make('employee.name')
                ->label('Employee Name'),
            ExportColumn::make('employee.logged_on_user')
                ->label('Logged On User'),
            ExportColumn::make('ip_address'),
            ExportColumn::make('mac_address'),
            ExportColumn::make('manufacturer.name')
                ->label('Manufacturer'),
            ExportColumn::make('model'),
            ExportColumn::make('device_name'),
            ExportColumn::make('cpu'),
            ExportColumn::make('ram'),
            ExportColumn::make('ram_speed'),
            ExportColumn::make('hard_disk'),
            ExportColumn::make('monitor'),
            ExportColumn::make('operatingSystem.name')
                ->label('OS Name'),
            ExportColumn::make('os_installation_date'),
            ExportColumn::make('msOffice.name')
                ->label('MS Office Name'),
            ExportColumn::make('location_within_branch'),
            ExportColumn::make('username'),
            ExportColumn::make('created_at'),
            ExportColumn::make('updated_at'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your device export has completed and ' . Str::of('row')->counted($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . Str::of('row')->counted($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
