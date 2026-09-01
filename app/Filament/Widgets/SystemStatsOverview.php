<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class SystemStatsOverview extends StatsOverviewWidget
{
    protected int | string | array $columnSpan = 'full';
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        return [
            Stat::make('Total Devices', \App\Models\Device::count())
                ->description('All registered devices')
                ->descriptionIcon('heroicon-m-computer-desktop')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('primary'),
            Stat::make('Total Branches', \App\Models\Branch::count())
                ->description('Active branches')
                ->descriptionIcon('heroicon-m-building-office')
                ->chart([2, 5, 3, 7, 5, 10, 12])
                ->color('success'),
            Stat::make('Total Employees', \App\Models\Employee::count())
                ->description('Company employees')
                ->descriptionIcon('heroicon-m-users')
                ->chart([15, 4, 10, 2, 12, 4, 15])
                ->color('warning'),
            Stat::make('Total Companies', \App\Models\Company::count())
                ->description('Registered companies')
                ->descriptionIcon('heroicon-m-building-office-2')
                ->chart([1, 2, 1, 3, 2, 4, 5])
                ->color('info'),
        ];
    }
}
