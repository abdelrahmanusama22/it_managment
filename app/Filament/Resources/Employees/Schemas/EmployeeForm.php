<?php

namespace App\Filament\Resources\Employees\Schemas;

use Filament\Schemas\Schema;

class EmployeeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Forms\Components\Select::make('branch_id')
                    ->relationship('branch', 'name')
                    ->searchable()->preload()
                    ->required(),
                \Filament\Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                \Filament\Forms\Components\TextInput::make('logged_on_user')
                    ->label('Logged On User')
                    ->maxLength(255),
            ]);
    }
}
