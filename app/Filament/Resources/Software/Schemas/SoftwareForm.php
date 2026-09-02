<?php

namespace App\Filament\Resources\Software\Schemas;

use Filament\Schemas\Schema;

class SoftwareForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Forms\Components\TextInput::make('os_name')->required()->label('OS Name'),
                \Filament\Forms\Components\TextInput::make('ms_office_name')->required()->label('MS Office Name'),
            ]);
    }
}
