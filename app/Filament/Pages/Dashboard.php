<?php

namespace App\Filament\Pages;

use App\Filament\Resources\OrderResource\Widgets\OrdersChart;
use App\Filament\Resources\VehicleResource\Widgets\MoreThan20DayVehicle;
use App\Filament\Resources\VehicleResource\Widgets\VehicleOverview;

class Dashboard extends \Filament\Pages\Dashboard
{
    // ...
    //
    public static function shouldRegisterNavigation(): bool
    {
        return auth()->user()->hasRole('Admin');
    }

    public function getWidgets(): array
    {
        return [
            VehicleOverview::class,
            OrdersChart::class,
            MoreThan20DayVehicle::class
        ];
    }
}
