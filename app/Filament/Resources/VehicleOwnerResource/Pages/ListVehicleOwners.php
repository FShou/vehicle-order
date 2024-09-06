<?php

namespace App\Filament\Resources\VehicleOwnerResource\Pages;

use App\Filament\Resources\VehicleOwnerResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListVehicleOwners extends ListRecords
{
    protected static string $resource = VehicleOwnerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
