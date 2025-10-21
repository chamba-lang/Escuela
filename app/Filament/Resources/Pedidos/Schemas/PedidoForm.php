<?php

namespace App\Filament\Resources\Pedidos\Schemas;

use App\Models\Producto;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;

class PedidoForm
{
    public static function configure(Schema $schema): Schema
    {
      $productos = Producto::get();

      return $schema
        ->schema([
              Select::make('cliente_id')
                ->relationship('cliente','nombre_completo')
                ->required(),
              DatePicker::make('fecha')
                ->default(now()),
              Toggle::make('estatus')
                ->required(),
              Repeater::make('pedidoProductos')
                ->relationship('pedidoProductos')
                ->label('productos')
                ->columnSpanFull()
                ->schema([
                  Select::make('producto_id')
                    ->relationship('producto','nombre')
                    ->options(
                        $productos->mapWithKeys(fn (Producto $producto) => 
                          [$producto->id => sprintf('%s ($%s)', $producto->nombre, $producto->precio)])
                    )
                    ->required(),
                  TextInput::make('cantidad')
                      ->integer()
                      ->default(1)
                      ->required()
                ])
                ->live()
                ->afterStateUpdated(function (Get $get, Set $set) {
                            self::updateTotals($get, $set);
                        }),
              TextInput::make('total')
                ->numeric()
                ->readonly()
                ->prefix('$')
                
        ]);
    }

    public static function updateTotals(Get $get, Set $set): void
  {
      $selectedProducts = collect($get('pedidoProductos'))->filter(fn($item) => !empty($item['producto_id']) && !empty($item['cantidad']));
  
      $precio = Producto::find($selectedProducts->pluck('producto_id'))->pluck('precio', 'id');
  
      $total = $selectedProducts->reduce(function ($total, $producto) use ($precio) {
          return $total + ($precio[$producto['producto_id']] * $producto['cantidad']);
      }, 0);
  
      $set('total', number_format($total, 2, '.', ''));
      
  }
}


//guia de https://laraveldaily.com/post/filament-repeater-live-calculations-on-update