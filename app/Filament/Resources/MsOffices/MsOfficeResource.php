<?php

namespace App\Filament\Resources\MsOffices;

use App\Filament\Resources\MsOffices\Pages\CreateMsOffice;
use App\Filament\Resources\MsOffices\Pages\EditMsOffice;
use App\Filament\Resources\MsOffices\Pages\ListMsOffices;
use App\Filament\Resources\MsOffices\Schemas\MsOfficeForm;
use App\Filament\Resources\MsOffices\Tables\MsOfficesTable;
use App\Models\MsOffice;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class MsOfficeResource extends Resource
{
    protected static ?string $model = MsOffice::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return MsOfficeForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MsOfficesTable::configure($table);
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
            'index' => ListMsOffices::route('/'),
            'create' => CreateMsOffice::route('/create'),
            'edit' => EditMsOffice::route('/{record}/edit'),
        ];
    }
}
