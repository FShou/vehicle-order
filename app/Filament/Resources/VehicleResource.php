<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VehicleResource\Pages;
use App\Filament\Resources\VehicleResource\RelationManagers;
use App\Models\Vehicle;
use Filament\Forms;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class VehicleResource extends Resource
{
    protected static ?string $model = Vehicle::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->required(),
                TextInput::make('licence_plate')
                    ->unique()
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
                DateTimePicker::make('lease_expiration_date')
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
                    // ->enum([
                    //     'passanger' => 'Passanger Vehicle',
                    //     'cargo' => 'Cargo Vehicle'
                    // ])
                ,
                TextColumn::make('fuel_type')
                    // ->enum([
                    //     'solar' => 'Solar',
                    //     'pertalite' => 'Pertalite',
                    //     'pertamax' => 'Pertamax'
                    // ])
                ,
                TextColumn::make('remaining_fuel_bar'),
                TextColumn::make('status')
                    // ->formatState([
                    //     'need_maintenance' => 'Need Maintenance',
                    //     'maintenance' => 'Under Maintenance',
                    //     'in_use' => "In use",
                    //     'available' => "Available"
                    // ])
                ,

                //
            ])
            ->filters([
                //
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
