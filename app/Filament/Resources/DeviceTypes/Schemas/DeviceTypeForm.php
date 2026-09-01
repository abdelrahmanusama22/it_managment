<?php

namespace App\Filament\Resources\DeviceTypes\Schemas;

use Filament\Schemas\Schema;

class DeviceTypeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
            ]);
    }
}
