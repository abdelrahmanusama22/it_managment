<?php

namespace App\Filament\Resources\Software;

use App\Filament\Resources\Software\Pages\CreateSoftware;
use App\Filament\Resources\Software\Pages\EditSoftware;
use App\Filament\Resources\Software\Pages\ListSoftware;
use App\Filament\Resources\Software\Schemas\SoftwareForm;
use App\Filament\Resources\Software\Tables\SoftwareTable;
use App\Models\Software;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class SoftwareResource extends Resource
{
    protected static ?string $model = Software::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-cube';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return SoftwareForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SoftwareTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSoftware::route('/'),
            'create' => CreateSoftware::route('/create'),
            'edit' => EditSoftware::route('/{record}/edit'),
        ];
    }
}
