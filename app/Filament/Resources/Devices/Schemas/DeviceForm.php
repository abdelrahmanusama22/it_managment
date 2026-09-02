<?php

namespace App\Filament\Resources\Devices\Schemas;

use Filament\Schemas\Schema;

class DeviceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Schemas\Components\Tabs::make('Tabs')
                    ->tabs([
                        \Filament\Schemas\Components\Tabs\Tab::make('Relations & Placement')
                            ->schema([
                                \Filament\Forms\Components\Select::make('company_id')
                                    ->relationship('company', 'name')
                                    ->live()
                                    ->afterStateUpdated(fn (\Filament\Schemas\Components\Utilities\Set $set) => $set('branch_id', null))
                                    ->searchable()->preload(),
                                \Filament\Forms\Components\Select::make('branch_id')
                                    ->label('Branch')
                                    ->options(function (\Filament\Schemas\Components\Utilities\Get $get) {
                                        $companyId = $get('company_id');
                                        if (! $companyId) {
                                            return \App\Models\Branch::pluck('name', 'id');
                                        }
                                        return \App\Models\Branch::where('company_id', $companyId)->pluck('name', 'id');
                                    })
                                    ->searchable()->preload()
                                    ->required(),
                                \Filament\Forms\Components\Select::make('device_type_id')
                                    ->relationship('deviceType', 'name')
                                    ->searchable()->preload()
                                    ->required(),
                                \Filament\Forms\Components\Select::make('employee_id')
                                    ->relationship('employee', 'name')
                                    ->getOptionLabelFromRecordUsing(fn ($record) => $record->name . ($record->logged_on_user ? " ({$record->logged_on_user})" : ''))
                                    ->searchable(['name', 'logged_on_user'])
                                    ->preload(),
                                \Filament\Forms\Components\TextInput::make('location_within_branch')
                                    ->maxLength(255),
                            ]),
                        \Filament\Schemas\Components\Tabs\Tab::make('Network Info')
                            ->schema([
                                \Filament\Forms\Components\TextInput::make('ip_address')
                                    ->maxLength(255),
                                \Filament\Forms\Components\TextInput::make('mac_address')
                                    ->maxLength(255),
                            ]),
                        \Filament\Schemas\Components\Tabs\Tab::make('Hardware Info')
                            ->schema([
                                \Filament\Forms\Components\Select::make('manufacturer_id')
                                    ->relationship('manufacturer', 'name')
                                    ->searchable()->preload()
                                    ->createOptionForm([
                                        \Filament\Forms\Components\TextInput::make('name')->required(),
                                    ]),
                                \Filament\Forms\Components\TextInput::make('model')
                                    ->maxLength(255),
                                \Filament\Forms\Components\TextInput::make('device_name')
                                    ->maxLength(255),
                                \Filament\Forms\Components\TextInput::make('cpu')
                                    ->maxLength(255),
                                \Filament\Forms\Components\TextInput::make('ram')
                                    ->maxLength(255),
                                \Filament\Forms\Components\TextInput::make('ram_speed')
                                    ->maxLength(255),
                                \Filament\Forms\Components\TextInput::make('hard_disk')
                                    ->maxLength(255),
                                \Filament\Forms\Components\TextInput::make('monitor')
                                    ->maxLength(255),
                            ]),
                        \Filament\Schemas\Components\Tabs\Tab::make('Software Info')
                            ->schema([
                                \Filament\Forms\Components\Select::make('software_id')
                                    ->relationship('software', 'os_name')
                                    ->getOptionLabelFromRecordUsing(fn ($record) => "OS: {$record->os_name} | Office: {$record->ms_office_name}")
                                    ->label('Software (OS & Office)')
                                    ->searchable()->preload()
                                    ->createOptionForm([
                                        \Filament\Forms\Components\TextInput::make('os_name')->required()->label('OS Name'),
                                        \Filament\Forms\Components\TextInput::make('ms_office_name')->required()->label('MS Office Name'),
                                    ]),
                                \Filament\Forms\Components\DatePicker::make('os_installation_date'),
                            ]),
                        \Filament\Schemas\Components\Tabs\Tab::make('Credentials')
                            ->schema([
                                \Filament\Forms\Components\TextInput::make('username')
                                    ->maxLength(255),
                                \Filament\Forms\Components\TextInput::make('password')
                                    ->password()
                                    ->revealable()
                                    ->dehydrated(fn ($state) => filled($state))
                                    ->maxLength(255),
                            ]),
                    ])
                    ->columnSpanFull()
            ]);
    }
}
