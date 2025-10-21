<?php

namespace App\Filament\Resources\Pedidos\Schemas;

use App\Models\Producto;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class PedidoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('cliente_id')
                    ->relationship('cliente', 'nombre_completo')
                    ->required(),
                Repeater::make('productos')
                    ->label('Productos del pedido')
                    ->schema([
                        Select::make('producto_id')
                            ->label('Producto')
                            ->options(Producto::all()->pluck('nombre','id'))
                            ->required(),
                        TextInput::make('cantidad')
                            ->label('Cantidad')
                            ->numeric()
                            ->default(1)
                            ->required(),

                    ])
                    ->columns(2)
                    ->createItemButtonLabel('Agregar producto'),
                TextInput::make('total')
                    ->required()
                    ->dehydrated(false),
                DatePicker::make('fecha')
                    ->default(now())
                    ->required(),
                Toggle::make('estatus')
                    ->label('Estado')
                    ->required(),
            ]);
    }
}
