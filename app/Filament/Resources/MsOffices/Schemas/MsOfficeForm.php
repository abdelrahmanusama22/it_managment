<?php

namespace App\Filament\Resources\MsOffices\Schemas;

use Filament\Schemas\Schema;

class MsOfficeForm
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
