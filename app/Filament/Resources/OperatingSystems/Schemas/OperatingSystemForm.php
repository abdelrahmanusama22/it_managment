<?php

namespace App\Filament\Resources\OperatingSystems\Schemas;

use Filament\Schemas\Schema;

class OperatingSystemForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true),
            ]);
    }
}
