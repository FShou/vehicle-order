<?php

namespace App\Filament\Resources\OrderResource\Widgets;

use App\Models\Driver;
use App\Models\Order;
use App\Models\User;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class OrdersChart extends ChartWidget
{
    protected static ?string $heading = 'Orders this year';

    public static function canView(): bool
    {
        return auth()->user()->hasRole('Admin');
    }
    protected function getData(): array
    {
        // Totals per month
         $data = Trend::model(Order::class)
            ->between(
                start: now()->startOfYear(),
                end: now()->endOfYear(),
            )
            ->perMonth()
            ->count();
        $data_approved = Trend::query(Order::query()->where('status','like','approved'))
            ->between(
                start: now()->startOfYear(),
                end: now()->endOfYear(),
            )
            ->perMonth()
            ->count();
        $data_rejected = Trend::query(Order::query()->where('status','like','rejected'))
            ->between(
                start: now()->startOfYear(),
                end: now()->endOfYear(),
            )
            ->perMonth()
            ->count();
        $data_done = Trend::query(Order::query()->where('status','like','done'))
            ->between(
                start: now()->startOfYear(),
                end: now()->endOfYear(),
            )
            ->perMonth()
            ->count();
        $data_canceled = Trend::query(Order::query()->where('status','like','canceled'))
            ->between(
                start: now()->startOfYear(),
                end: now()->endOfYear(),
            )
            ->perMonth()
            ->count();

        return [
            'datasets' => [
                [
                    'label' => 'Orders approved',
                    'data' => $data_approved->map(fn (TrendValue $value) => $value->aggregate),
                    'backgroundColor' => '#22c55e',
                    'borderColor' => '#ffff0000',
                ],
                [
                    'label' => 'Orders rejected',
                    'data' => $data_rejected->map(fn (TrendValue $value) => $value->aggregate),
                    'backgroundColor' => '#dc2626',
                    'borderColor' => '#ffff0000',
                ],
                [
                    'label' => 'Orders canceled',
                    'data' => $data_canceled->map(fn (TrendValue $value) => $value->aggregate),
                    'backgroundColor' => '#450a0a',
                    'borderColor' => '#ffff0000',
                ],
                [
                    'label' => 'Orders finised',
                    'data' => $data_done->map(fn (TrendValue $value) => $value->aggregate),
                    'backgroundColor' => '#0ea5e9',
                    'borderColor' => '#ffff0000',
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
