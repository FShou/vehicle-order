<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\Order;
use App\Models\Vehicle;
use DateTime;
use EightyNine\Approvals\Tables\Actions\ApprovalActions;
use Filament\Forms;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use pxlrbt\FilamentExcel\Actions\Tables\ExportAction;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Select::make('employee_id')
                    ->relationship('employee', 'name')
                    ->searchable()
                    ->preload()
                    ->columnSpan(2)
                    ->required()
                ,
                Select::make('vehicle_id')
                    ->label("Vehicle")
                    ->options(Vehicle::query()
                        ->whereNotIn('status', ['in_use', 'maintenance'])
                        ->pluck('name','id')
                    )
                    ->searchable()
                    ->preload()
                    ->required()
                ,
                Select::make('driver_id')
                    ->relationship('driver', 'name')
                    ->searchable()
                    ->preload()
                    ->required()
                ,
                TextArea::make('purpose')
                    ->maxLength(255)
                    ->columnSpan(2)
                    ->rows(5)
                    ->autosize()
                    ->required()
                ,
                Select::make('status')
                    ->options([
                        'waiting' => 'Waiting',
                        'rejected' => 'Rejected',
                        'approved' => 'Approved',
                        'done' => 'Done',
                        'delivered' => 'Delivered',
                    ])
                    ->columnSpan(2)
                    ->default('waiting')
                ,
                DateTimePicker::make('start_date')
                    ->required()
                ,
                DateTimePicker::make('end_date')
                    ->afterOrEqual('start_date')
                    ->required()
                ,
                DateTimePicker::make('taken_date')
                ,
                DateTimePicker::make('return_date')
                    ->afterOrEqual('start_date')

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('id')
                    ->searchable()
                ,
                TextColumn::make('employee.name'),
                TextColumn::make('vehicle.name'),
                TextColumn::make('driver.name'),
                TextColumn::make('start_date')
                    ->dateTime('d/m/Y, h:i A')
                ,
                TextColumn::make('end_date')
                    ->dateTime('d/m/Y, h:i A')
                ,
                \EightyNine\Approvals\Tables\Columns\ApprovalStatusColumn::make("approvalStatus.status")
                ,
                TextColumn::make('status')
                    ->label('Order Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'waiting' => 'gray',
                        'approved' => 'success',
                        'delivered' => 'purple',
                        'done' => 'info',
                        'rejected' => 'danger',
                    })
                ,
                TextColumn::make('taken_date')
                    ->toggleable(isToggledHiddenByDefault:true)
                ,

                TextColumn::make('return_date')
                    ->toggleable(isToggledHiddenByDefault:true)
                ,
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'waiting' => 'Waiting',
                        'rejected' => 'Rejected',
                        'approved' => 'Approved',
                        'done' => 'Done',
                        'delivered' => 'Delivered',
                    ])
            ])
            ->actions(
                ApprovalActions::make(
                    [
                        Tables\Actions\EditAction::make(),
                    ]
                )
            )
            ->headerActions([
                ExportAction::make()->exports([
                    ExcelExport::make()
                            ->fromTable()
                            ->askForFilename()
                            ->askForWriterType()
                ])
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
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
