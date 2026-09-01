<?php

namespace App\Filament\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use App\Models\Device;

class LatestDevices extends BaseWidget
{
    protected static ?int $sort = 4;
    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Device::latest()->limit(5)
            )
            ->heading('Latest Added Devices')
            ->paginated(false)
            ->columns([
                Tables\Columns\TextColumn::make('device_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('deviceType.name')
                    ->badge(),
                Tables\Columns\TextColumn::make('branch.name')
                    ->searchable(),
            ]);
    }
}
