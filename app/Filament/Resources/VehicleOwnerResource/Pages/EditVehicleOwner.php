<?php

namespace App\Filament\Resources\VehicleOwnerResource\Pages;

use App\Filament\Resources\VehicleOwnerResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditVehicleOwner extends EditRecord
{
    protected static string $resource = VehicleOwnerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
