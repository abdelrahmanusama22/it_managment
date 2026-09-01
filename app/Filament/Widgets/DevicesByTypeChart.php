<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

class DevicesByTypeChart extends ChartWidget
{
    protected ?string $heading = 'Devices By Type';
    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $data = \App\Models\Device::select('device_type_id', \Illuminate\Support\Facades\DB::raw('count(*) as total'))
            ->groupBy('device_type_id')
            ->get();

        $labels = [];
        $counts = [];

        foreach ($data as $row) {
            $type = \App\Models\DeviceType::find($row->device_type_id);
            $labels[] = $type ? $type->name : 'Unknown';
            $counts[] = $row->total;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Devices',
                    'data' => $counts,
                    'backgroundColor' => [
                        '#f59e0b', '#3b82f6', '#10b981', '#ef4444', '#8b5cf6', '#06b6d4',
                    ],
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
