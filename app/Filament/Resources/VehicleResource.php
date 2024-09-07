<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VehicleResource\Pages;
use App\Filament\Resources\VehicleResource\RelationManagers;
use App\Filament\Resources\VehicleResource\Widgets\VehicleOverview;
use App\Models\Vehicle;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class VehicleResource extends Resource
{
    protected static ?string $model = Vehicle::class;
    protected static ?string $navigationGroup = 'Vehicle';

    protected static ?string $navigationIcon = 'heroicon-o-truck';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->required(),
                TextInput::make('licence_plate')
                    ->unique(ignoreRecord:true)
                    ->required()
                ,
                TextInput::make('distance_covered')
                    ->integer()
                    ->label("Distance Covered (Km)")
                    ->required()
                ,
                TextInput::make('remaining_fuel_bar')
                    ->integer()
                    ->minValue(0)
                    ->maxValue(4)
                    ->required()
                ,
                Select::make('vehicle_owner_id')
                    ->relationship('vehicle_owner','company_name')
                    ->searchable()
                    ->preload()
                    ->createOptionForm([
                        TextInput::make('company_name'),
                        TextInput::make('address')
                    ])
                    ->required()
                ,
                Select::make('type')
                    ->options([
                        'passanger' => 'Passanger Vehicle',
                        'cargo' => 'Cargo Vehicle'
                    ])
                    ->searchable()
                    ->default('passanger')
                    ->required()
                ,
                Select::make('fuel_type')
                    ->options([
                        'solar' => 'Solar',
                        'pertalite' => 'Pertalite',
                        'pertamax' => 'Pertamax'
                    ])
                    ->searchable()
                    ->default('solar')
                    ->required()
                ,
                Select::make('status')
                    ->options([
                        'need_maintenance' => 'Need Maintenance',
                        'maintenance' => 'Under Maintenance',
                        'in_use' => "In use",
                        'available' => "Available"
                    ])
                    ->searchable()
                    ->default('available')
                    ->required()
                ,
                DateTimePicker::make('lease_expiration_date')
                ,
                DateTimePicker::make('last_maintenance_date')
                ,

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
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

                //
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'need_maintenance' => 'Need Maintenance',
                        'maintenance' => 'Under Maintenance',
                        'in_use' => "In use",
                        'available' => "Available"
                    ])
                ,
                SelectFilter::make('type')
                    ->options([
                        'passanger' => 'Passanger Vehicle',
                        'cargo' => 'Cargo Vehicle'
                    ])
                ,
                SelectFilter::make('fuel_type')
                    ->options([
                        'solar' => 'Solar',
                        'pertalite' => 'Pertalite',
                        'pertamax' => 'Pertamax'
                    ])
                ,
                Filter::make('last_maintenance_date')
                    ->form([
                        Toggle::make('20-more')
                        ->label("More than 20 days last maintenance")
                    ])
                    ->query(function (Builder $query, array $data) {
                    if ($data['20-more']) {
                        $dateThreshold = Carbon::now()->subDays(20);

                        // Apply the filter to the query
                        $query->where('last_maintenance_date', '<=', $dateThreshold);
                    }
                })
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getWidgets(): array
    {
        return [
            VehicleOverview::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVehicles::route('/'),
            'create' => Pages\CreateVehicle::route('/create'),
            'view' => Pages\ViewVehicle::route('/{record}'),
            'edit' => Pages\EditVehicle::route('/{record}/edit'),
        ];
    }
}
