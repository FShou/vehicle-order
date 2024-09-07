<?php

namespace App\Filament\Resources\VehicleResource\Widgets;

use App\Models\Vehicle;
use Carbon\Carbon;
use Filament\Actions\Action;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class MoreThan20DayVehicle extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';



    public static function canView(): bool
    {
        return auth()->user()->hasRole('Admin');
    }




    public function table(Table $table): Table
    {
        $dateThreshold = Carbon::now()->subDay(20);
        return $table
            ->heading("Vehicle last maintenance more than 20 days")
            ->query(Vehicle::query()->where('last_maintenance_date', '<=', $dateThreshold))
            ->columns([
                TextColumn::make('name')->searchable(),
                TextColumn::make('licence_plate')->searchable(),
                TextColumn::make('type')
                    ->formatStateUsing(fn (string $state): string => ucwords($state) )
                ,
                TextColumn::make('fuel_type')
                    ->formatStateUsing(fn (string $state): string => ucwords($state) )
                ,
                TextColumn::make('remaining_fuel_bar'),

                TextColumn::make('last_maintenance_date')
                    ->dateTime('d/m/Y, h:i A')
                ,
                TextColumn::make('lease_expiration_date')
                    ->dateTime('d/m/Y, h:i A')
                    ->toggleable(isToggledHiddenByDefault:true)
                ,
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'need_maintenance' => 'danger' ,
                        'maintenance' => 'warning',
                        'in_use' => 'info',
                        'available' => 'success'
                    })
                ,
            ]);

    }
}
