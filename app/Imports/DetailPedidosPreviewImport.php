<?php

namespace App\Imports;

use App\Models\DetailPedidos;
use App\Models\Pedidos;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class DetailPedidosPreviewImport implements ToCollection
{
    public $data;
    public $key;

    public function collection(Collection $rows)
    {
        $row_nuevos = 0;
        $row_no_encontrados = 0;
        $row_existentes = 0;
        $row_modificados = 0;
        $formato_incorrecto = false; 
        $detalle = "DETALLADO DE ARTÍCULOS:\n";

        $colMap = [
            'numero' => 0,
            'articulo' => 1,
            'cantidad' => 2,
            'precio' => 3,
            'subtotal' => 4,
        ];
        if ($rows->count() > 0) {
            $headers = $rows->first();
            $maybeHeader = collect($headers)->map(function ($v) { return is_string($v) ? strtolower(trim($v)) : $v; })->toArray();
            $nameToKey = [
                'numero' => ['numero', 'número', 'pedido', 'nro', 'nro pedido'],
                'articulo' => ['articulo', 'artículo', 'producto', 'item'],
                'cantidad' => ['cantidad', 'cant'],
                'precio' => ['preciounitario', 'precio unitario', 'precio', 'p. unitario'],
                'subtotal' => ['subtotal', 'sub total', 'total linea', 'total línea'],
            ];
            foreach ($nameToKey as $key => $aliases) {
                foreach ($maybeHeader as $idx => $label) {
                    if (!is_string($label)) continue;
                    if (in_array($label, $aliases, true)) {
                        $colMap[$key] = (int)$idx;
                        break;
                    }
                }
            }
        }

        foreach ($rows as $row) {
            if (!is_array($row)) { $row = $row->toArray(); }
            // Skip empty lines
            if (count(array_filter($row, fn($v) => $v !== null && $v !== '')) === 0) { continue; }

            // Detect and skip header rows
            $numeroRaw = isset($row[$colMap['numero']]) ? strtolower(trim((string)$row[$colMap['numero']])) : '';
            if (in_array($numeroRaw, ['numero', 'número', 'pedido'])) { continue; }

            // Validate minimal required columns; skip malformed rows instead of failing
            if (!isset($row[$colMap['numero']], $row[$colMap['articulo']], $row[$colMap['cantidad']])) {
                continue;
            }

            $pedidoIdRaw = trim((string)$row[$colMap['numero']]);
            $pedido = Pedidos::where('orderId', $pedidoIdRaw)->first();
            if (!$pedido && is_numeric($pedidoIdRaw)) {
                $pedido = Pedidos::where('orderId', (int)$pedidoIdRaw)->first();
            }
            if (!$pedido) {
                $pedido = Pedidos::where('nroOrder', $pedidoIdRaw)->first();
                if (!$pedido && is_numeric($pedidoIdRaw)) {
                    $pedido = Pedidos::where('nroOrder', (int)$pedidoIdRaw)->first();
                }
            }
            if (!$pedido) { $row_no_encontrados++; continue; }

            $articulo = trim((string)$row[$colMap['articulo']]);
            $cantidad = (float)($row[$colMap['cantidad']] ?? 0);
            $unit = isset($row[$colMap['precio']]) ? round((float)$row[$colMap['precio']], 3) : 0.0;
            $sub = isset($row[$colMap['subtotal']]) ? round((float)$row[$colMap['subtotal']], 3) : round($cantidad * $unit, 3);

            // Check production status validation rules
            // Skip modifications if pedido is in "Preparado" status (2)
            if ($pedido->productionStatus === 2) {
                // Skip this row - no changes allowed for "Preparado" orders
                $detalle .= 'Pedido: '.$pedido->orderId.' '.$articulo.' cantidad:'.$cantidad.' (pedido preparado - sin cambios)'."\n";
                $row_existentes++;
                continue;
            }
            
            // Only allow changes if status is PENDIENTE (0) or allow progression to En Preparación (1)

            $pedido_exist = DetailPedidos::where('pedidos_id', $pedido->id)
                ->whereRaw('UPPER(TRIM(articulo)) = UPPER(TRIM(?))', [$articulo])
                ->first();

            if (!$pedido_exist) {
                $detallePedido = new DetailPedidos();
                $detallePedido->pedidos_id = $pedido->id;
                $detallePedido->articulo = $articulo;
                $detallePedido->cantidad = $cantidad;
                $detallePedido->unit_prize = $unit;
                $detallePedido->sub_total = $sub;
                $detallePedido->created_at = now();
                $detallePedido->save();

                // Update pedido status and timestamp
                $pedido->last_data_update = now();
                
                // If pedido is currently PENDIENTE (0), update to En Preparación (1)
                if ($pedido->productionStatus == 0) {
                    $pedido->productionStatus = 1; // En Preparación
                }
                
                $pedido->save();

                $row_nuevos++;
            } else {
                $hasChanges = false;
                if ((float)$pedido_exist->cantidad != (float)$cantidad) { $pedido_exist->cantidad = $cantidad; $hasChanges = true; }
                if (round((float)$pedido_exist->unit_prize, 3) !== $unit) { $pedido_exist->unit_prize = $unit; $hasChanges = true; }
                if (round((float)$pedido_exist->sub_total, 3) !== $sub) { $pedido_exist->sub_total = $sub; $hasChanges = true; }

                if ($hasChanges) {
                    $pedido_exist->save();
                    
                    // Update pedido status and timestamp
                    $pedido->last_data_update = now();
                    
                    // If pedido is currently PENDIENTE (0), update to En Preparación (1)
                    if ($pedido->productionStatus == 0) {
                        $pedido->productionStatus = 1; // En Preparación
                    }
                    
                    $pedido->save();
                    $row_modificados++;
                } else {
                    $detalle .= 'Pedido: '.$pedido->orderId.' '.$articulo.' cantidad:'.$cantidad.' (sin cambios)'."\n";
                    $row_existentes++;
                }
            }
        }

        // If nothing was processed at all, return a warning instead of a hard error
        if (($row_nuevos + $row_modificados + $row_existentes + $row_no_encontrados) === 0) {
            $this->data = 'No se encontraron filas válidas para procesar en el archivo de artículos.';
            $this->key = 'warning';
            return;
        }

        $rpta = 'Artículos registrados: '.$row_nuevos."\n".
                'Artículos modificados: '.$row_modificados."\n".
                'Artículos sin cambios: '.$row_existentes."\n".
                'Pedidos no encontrados: '.$row_no_encontrados."\n".
                $detalle;

        $this->data = $rpta;
        $this->key = $row_nuevos + $row_modificados > 0 ? ($row_no_encontrados > 0 ? 'warning' : 'success') : ($row_no_encontrados > 0 ? 'warning' : 'success');
    }
}
