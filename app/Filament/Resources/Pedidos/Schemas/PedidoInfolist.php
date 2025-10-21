<?php

namespace App\Filament\Resources\Pedidos\Schemas;

use App\Models\Pedido;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class PedidoInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('cliente.nombre_completo')
                    ->numeric(),
                TextEntry::make('total')
                    ->numeric(),
                TextEntry::make('fecha'),
                IconEntry::make('estatus')
                    ->boolean(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
