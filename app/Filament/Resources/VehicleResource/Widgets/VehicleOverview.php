<?php

namespace App\Filament\Resources\VehicleResource\Widgets;

use App\Filament\Resources\VehicleResource\Pages\ListVehicles;
use App\Models\Vehicle;
use Filament\Widgets\Concerns\InteractsWithPageTable;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class VehicleOverview extends BaseWidget
{

    public static function canView(): bool
    {
        return auth()->user()->hasRole('Admin');
    }

    protected function getStats(): array
    {
        $total_available = Vehicle::query()->where('status', 'like', 'available')->count();
        $total_maintenance = Vehicle::query()->where('status', 'like' , 'maintenance')->count();
        $total_needmaintenance = Vehicle::query()->where('status', 'like' , 'need_maintenance')->count();
        $total_inUse = Vehicle::query()->where('status', 'like' , 'in_use')->count();
        return [
            Stat::make('Total available', $total_available)
                ->description('Available vehicle')
                ->color('success')
            ,
            Stat::make('Total under maintenance', $total_maintenance)
                ->description('Vehicle currently undermaintenance')
                ->color('warning')
            ,
            Stat::make('Total in use', $total_inUse)
                ->description('Vehicles that being used')
                ->color('info')
            ,
            Stat::make('Total need maintenance', $total_needmaintenance)
                ->description('Vehicle that need maintenance')
                ->color('danger')
            ,
        ];
    }
}
