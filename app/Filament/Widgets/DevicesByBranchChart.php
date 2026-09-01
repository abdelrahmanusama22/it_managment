<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

class DevicesByBranchChart extends ChartWidget
{
    protected ?string $heading = 'Devices By Branch';
    protected static ?int $sort = 3;

    protected function getData(): array
    {
        $data = \App\Models\Device::select('branch_id', \Illuminate\Support\Facades\DB::raw('count(*) as total'))
            ->groupBy('branch_id')
            ->get();

        $labels = [];
        $counts = [];

        foreach ($data as $row) {
            $branch = \App\Models\Branch::find($row->branch_id);
            $labels[] = $branch ? $branch->name : 'Unknown';
            $counts[] = $row->total;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Devices',
                    'data' => $counts,
                    'backgroundColor' => '#3b82f6',
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
