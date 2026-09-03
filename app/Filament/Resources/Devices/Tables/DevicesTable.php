<?php

namespace App\Filament\Resources\Devices\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;

class DevicesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                \Filament\Tables\Columns\TextColumn::make('sku')
                    ->label('SKU')
                    ->searchable()
                    ->sortable(),
                \Filament\Tables\Columns\TextColumn::make('device_name')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                \Filament\Tables\Columns\TextColumn::make('deviceType.name')
                    ->label('Device Type')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                \Filament\Tables\Columns\TextColumn::make('branch.name')
                    ->label('Branch')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                \Filament\Tables\Columns\TextColumn::make('employee.name')
                    ->label('Employee')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                \Filament\Tables\Columns\TextColumn::make('employee.logged_on_user')
                    ->label('Logged On User')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                \Filament\Tables\Columns\TextColumn::make('ip_address')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                \Filament\Tables\Columns\TextColumn::make('operatingSystem.name')
                    ->label('OS Name')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                \Filament\Tables\Columns\TextColumn::make('msOffice.name')
                    ->label('MS Office Name')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                \Filament\Tables\Columns\TextColumn::make('company.name')
                    ->label('Company')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                \Filament\Tables\Columns\TextColumn::make('manufacturer.name')
                    ->label('Manufacturer')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                \Filament\Tables\Columns\TextColumn::make('mac_address')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                \Filament\Tables\Columns\TextColumn::make('model')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                \Filament\Tables\Columns\TextColumn::make('cpu')
                    ->label('CPU')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                \Filament\Tables\Columns\TextColumn::make('ram')
                    ->label('RAM')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                \Filament\Tables\Columns\TextColumn::make('ram_speed')
                    ->label('RAM Speed')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                \Filament\Tables\Columns\TextColumn::make('hard_disk')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                \Filament\Tables\Columns\TextColumn::make('monitor')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                \Filament\Tables\Columns\TextColumn::make('os_installation_date')
                    ->label('OS Installation Date')
                    ->date()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                \Filament\Tables\Columns\TextColumn::make('location_within_branch')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                \Filament\Tables\Columns\TextColumn::make('username')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                \Filament\Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                \Filament\Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                \Filament\Tables\Filters\SelectFilter::make('company_id')
                    ->relationship('company', 'name')
                    ->label('Company'),
                \Filament\Tables\Filters\SelectFilter::make('branch_id')
                    ->relationship('branch', 'name')
                    ->label('Branch'),
                \Filament\Tables\Filters\SelectFilter::make('device_type_id')
                    ->relationship('deviceType', 'name')
                    ->label('Device Type'),
                \Filament\Tables\Filters\SelectFilter::make('employee_id')
                    ->relationship('employee', 'name')
                    ->label('Employee'),
                \Filament\Tables\Filters\SelectFilter::make('manufacturer_id')
                    ->relationship('manufacturer', 'name')
                    ->label('Manufacturer'),
                \Filament\Tables\Filters\SelectFilter::make('operating_system_id')
                    ->relationship('operatingSystem', 'name')
                    ->label('OS Name'),
                \Filament\Tables\Filters\SelectFilter::make('ms_office_id')
                    ->relationship('msOffice', 'name')
                    ->label('MS Office'),

                \Filament\Tables\Filters\Filter::make('device_name')
                    ->form([\Filament\Forms\Components\TextInput::make('device_name')->label('Device Name')])
                    ->query(fn ($query, array $data) => $query->when($data['device_name'], fn ($q, $v) => $q->where('device_name', 'like', "%{$v}%"))),

                \Filament\Tables\Filters\Filter::make('employee_logged_on_user')
                    ->form([\Filament\Forms\Components\TextInput::make('logged_on_user')->label('Logged On User')])
                    ->query(fn ($query, array $data) => $query->when($data['logged_on_user'], fn ($q, $v) => $q->whereHas('employee', fn ($eq) => $eq->where('logged_on_user', 'like', "%{$v}%")))),

                \Filament\Tables\Filters\Filter::make('ip_address')
                    ->form([\Filament\Forms\Components\TextInput::make('ip_address')->label('IP Address')])
                    ->query(fn ($query, array $data) => $query->when($data['ip_address'], fn ($q, $v) => $q->where('ip_address', 'like', "%{$v}%"))),

                \Filament\Tables\Filters\Filter::make('mac_address')
                    ->form([\Filament\Forms\Components\TextInput::make('mac_address')->label('MAC Address')])
                    ->query(fn ($query, array $data) => $query->when($data['mac_address'], fn ($q, $v) => $q->where('mac_address', 'like', "%{$v}%"))),

                \Filament\Tables\Filters\Filter::make('model')
                    ->form([\Filament\Forms\Components\TextInput::make('model')->label('Model')])
                    ->query(fn ($query, array $data) => $query->when($data['model'], fn ($q, $v) => $q->where('model', 'like', "%{$v}%"))),

                \Filament\Tables\Filters\Filter::make('cpu')
                    ->form([\Filament\Forms\Components\TextInput::make('cpu')->label('CPU')])
                    ->query(fn ($query, array $data) => $query->when($data['cpu'], fn ($q, $v) => $q->where('cpu', 'like', "%{$v}%"))),

                \Filament\Tables\Filters\Filter::make('ram')
                    ->form([\Filament\Forms\Components\TextInput::make('ram')->label('RAM')])
                    ->query(fn ($query, array $data) => $query->when($data['ram'], fn ($q, $v) => $q->where('ram', 'like', "%{$v}%"))),

                \Filament\Tables\Filters\Filter::make('ram_speed')
                    ->form([\Filament\Forms\Components\TextInput::make('ram_speed')->label('RAM Speed')])
                    ->query(fn ($query, array $data) => $query->when($data['ram_speed'], fn ($q, $v) => $q->where('ram_speed', 'like', "%{$v}%"))),

                \Filament\Tables\Filters\Filter::make('hard_disk')
                    ->form([\Filament\Forms\Components\TextInput::make('hard_disk')->label('Hard Disk')])
                    ->query(fn ($query, array $data) => $query->when($data['hard_disk'], fn ($q, $v) => $q->where('hard_disk', 'like', "%{$v}%"))),

                \Filament\Tables\Filters\Filter::make('monitor')
                    ->form([\Filament\Forms\Components\TextInput::make('monitor')->label('Monitor')])
                    ->query(fn ($query, array $data) => $query->when($data['monitor'], fn ($q, $v) => $q->where('monitor', 'like', "%{$v}%"))),

                \Filament\Tables\Filters\Filter::make('os_installation_date')
                    ->form([\Filament\Forms\Components\DatePicker::make('os_installation_date')->label('OS Installation Date')])
                    ->query(fn ($query, array $data) => $query->when($data['os_installation_date'], fn ($q, $v) => $q->whereDate('os_installation_date', $v))),

                \Filament\Tables\Filters\Filter::make('location_within_branch')
                    ->form([\Filament\Forms\Components\TextInput::make('location_within_branch')->label('Location Within Branch')])
                    ->query(fn ($query, array $data) => $query->when($data['location_within_branch'], fn ($q, $v) => $q->where('location_within_branch', 'like', "%{$v}%"))),

                \Filament\Tables\Filters\Filter::make('username')
                    ->form([\Filament\Forms\Components\TextInput::make('username')->label('Username')])
                    ->query(fn ($query, array $data) => $query->when($data['username'], fn ($q, $v) => $q->where('username', 'like', "%{$v}%"))),
            ])
            ->headerActions([
                // Removed duplicate ExportAction
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    \Filament\Actions\ExportBulkAction::make()
                        ->exporter(\App\Filament\Exports\DeviceExporter::class),
                ]),
            ]);
    }
}
