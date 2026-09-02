<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Device;

class SmartAlertsOverview extends BaseWidget
{
    protected static ?int $sort = 2;
    protected int | string | array $columnSpan = 'full';

    protected function getStats(): array
    {
        return [
            Stat::make('Unassigned Devices', Device::whereNull('employee_id')->count())
                ->description('Devices without an employee')
                ->descriptionIcon('heroicon-o-exclamation-triangle')
                ->color('warning'),
            Stat::make('Missing Software', Device::whereNull('software_id')->count())
                ->description('Devices without OS & Office assigned')
                ->descriptionIcon('heroicon-o-x-circle')
                ->color('danger'),
        ];
    }
}
