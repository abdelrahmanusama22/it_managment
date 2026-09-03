<?php

namespace App\Filament\Resources\Employees\Schemas;

use Filament\Schemas\Schema;

class EmployeeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                \Filament\Forms\Components\Select::make('company_id')
                    ->relationship('branch.company', 'name')
                    ->label('Company')
                    ->live()
                    ->dehydrated(false)
                    ->afterStateUpdated(fn (\Filament\Schemas\Components\Utilities\Set $set) => $set('branch_id', null))
                    ->searchable()
                    ->preload(),
                \Filament\Forms\Components\Select::make('branch_id')
                    ->relationship(
                        name: 'branch',
                        titleAttribute: 'name',
                        modifyQueryUsing: fn (\Illuminate\Database\Eloquent\Builder $query, \Filament\Schemas\Components\Utilities\Get $get) => 
                            filled($get('company_id')) ? $query->where('company_id', $get('company_id')) : $query
                    )
                    ->label('Branch')
                    ->searchable()
                    ->preload()
                    ->disabled(fn (\Filament\Schemas\Components\Utilities\Get $get): bool => !filled($get('company_id'))),
                \Filament\Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                \Filament\Forms\Components\TextInput::make('logged_on_user')
                    ->label('Logged On User')
                    ->maxLength(255),
            ]);
    }
}
