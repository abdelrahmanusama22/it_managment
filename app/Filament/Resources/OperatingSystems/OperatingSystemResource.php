<?php

namespace App\Filament\Resources\OperatingSystems;

use App\Filament\Resources\OperatingSystems\Pages\CreateOperatingSystem;
use App\Filament\Resources\OperatingSystems\Pages\EditOperatingSystem;
use App\Filament\Resources\OperatingSystems\Pages\ListOperatingSystems;
use App\Filament\Resources\OperatingSystems\Schemas\OperatingSystemForm;
use App\Filament\Resources\OperatingSystems\Tables\OperatingSystemsTable;
use App\Models\OperatingSystem;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class OperatingSystemResource extends Resource
{
    protected static ?string $model = OperatingSystem::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return OperatingSystemForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return OperatingSystemsTable::configure($table);
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
            'index' => ListOperatingSystems::route('/'),
            'create' => CreateOperatingSystem::route('/create'),
            'edit' => EditOperatingSystem::route('/{record}/edit'),
        ];
    }
}
