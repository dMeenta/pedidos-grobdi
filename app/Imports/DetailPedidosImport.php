<?php

namespace App\Imports;

use App\Models\DetailPedidos;
use App\Models\Pedidos;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class DetailPedidosImport implements ToCollection
{
    public $data;
    public $key;

    public function collection(Collection $rows)
    {
        $row_nuevos = 0;
        $row_no_encontrados = 0;
        $row_existentes = 0;
        $row_modificados = 0;
        $mensaje = "";
        $msj = "DETALLE DE PEDIDOS EXISTENTES: ";
        
        // Filter out completely empty rows
        $filteredRows = $rows->filter(function($row) {
            if (!is_array($row)) {
                $row = $row->toArray();
            }
            return !empty(array_filter($row, fn($v) => $v !== null && trim($v) !== ''));
        });
        
        // Detect column format
        $colMap = $this->detectColumns($filteredRows);
        
        foreach($filteredRows as $rowIndex => $row) {
            if (!is_array($row)) {
                $row = $row->toArray();
            }
            
            // Skip empty and header rows
            if ($this->shouldSkipRow($row, $colMap)) {
                continue;
            }
            
            // Validate required data exists
            if (!isset($row[$colMap['numero']]) || !isset($row[$colMap['articulo']]) || !isset($row[$colMap['cantidad']])) {
                continue;
            }
            
            $pedidoId = trim((string)$row[$colMap['numero']]);
            $articulo = trim((string)$row[$colMap['articulo']]);
            $cantidad = (float)$row[$colMap['cantidad']];
            $precio = isset($row[$colMap['precio']]) ? (float)$row[$colMap['precio']] : 0;
            $subtotal = isset($row[$colMap['subtotal']]) ? (float)$row[$colMap['subtotal']] : ($cantidad * $precio);
            
            // Skip invalid data
            if (empty($pedidoId) || empty($articulo) || $cantidad <= 0) {
                continue;
            }
            
            // Find the pedido
            $pedido = $this->findPedido($pedidoId);
            
            if (!$pedido) {
                ++$row_no_encontrados;
                continue;
            }
            
            // Check if article already exists with same data
            $pedido_exist = DetailPedidos::where('pedidos_id', $pedido->id)
                ->whereRaw('UPPER(TRIM(articulo)) = UPPER(TRIM(?))', [$articulo])
                ->first();
                
            if (empty($pedido_exist)) {
                // Create new article
                $detallePedido = new DetailPedidos();
                $detallePedido->pedidos_id = $pedido->id;
                $detallePedido->articulo = $articulo;
                $detallePedido->cantidad = $cantidad;
                $detallePedido->unit_prize = $precio;
                $detallePedido->sub_total = $subtotal;
                
                // Set created_at date (try to get from Excel or use current time)
                if (isset($row[$colMap['fecha']]) && !empty($row[$colMap['fecha']])) {
                    try {
                        $detallePedido->created_at = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[$colMap['fecha']]))->format('Y-m-d H:i:s');
                    } catch (\Exception $e) {
                        $detallePedido->created_at = now();
                    }
                } else {
                    $detallePedido->created_at = now();
                }
                
                $detallePedido->save();
                
                // Update the pedido's last_data_update timestamp
                $pedido->last_data_update = now();
                $pedido->save();
                
                ++$row_nuevos;
            } else {
                // Check if any data needs to be updated
                $needsUpdate = false;
                $changes = [];
                
                if ((float)$pedido_exist->cantidad !== $cantidad) {
                    $changes[] = "cantidad: {$pedido_exist->cantidad} → $cantidad";
                    $pedido_exist->cantidad = $cantidad;
                    $needsUpdate = true;
                }
                
                if (round((float)$pedido_exist->unit_prize, 3) !== round($precio, 3)) {
                    $changes[] = "precio: {$pedido_exist->unit_prize} → $precio";
                    $pedido_exist->unit_prize = $precio;
                    $needsUpdate = true;
                }
                
                if (round((float)$pedido_exist->sub_total, 3) !== round($subtotal, 3)) {
                    $changes[] = "subtotal: {$pedido_exist->sub_total} → $subtotal";
                    $pedido_exist->sub_total = $subtotal;
                    $needsUpdate = true;
                }
                
                if ($needsUpdate) {
                    $pedido_exist->save();
                    $pedido->last_data_update = now();
                    $pedido->save();
                    ++$row_modificados;
                    $msj .= "Pedido: $pedidoId - $articulo (" . implode(', ', $changes) . ")\n";
                } else {
                    ++$row_existentes;
                    $msj .= "Pedido: $pedidoId - $articulo (sin cambios)\n";
                }
            }
        }
        
        // Set response key based on results
        if ($row_no_encontrados > 0) {
            $this->key = "warning";
        } else {
            $this->key = "success";
        }
        
        $rpta = "Artículos nuevos: $row_nuevos\n";
        $rpta .= "Artículos modificados: $row_modificados\n";
        $rpta .= "Artículos sin cambios: $row_existentes\n";
        $rpta .= "Pedidos no encontrados: $row_no_encontrados\n\n";
        $rpta .= $msj;
        
        $this->data = $rpta;
    }
    
    private function detectColumns(Collection $rows)
    {
        // Default column mapping for new format
        $colMap = [
            'numero' => 0,      // Column A - Numero de pedido
            'articulo' => 1,    // Column B - Articulo
            'cantidad' => 2,    // Column C - Cantidad
            'precio' => 3,      // Column D - Precio unitario
            'subtotal' => 4,    // Column E - Sub total
            'fecha' => 21,      // Column V - Fecha (if exists)
        ];

        // Check if we're dealing with the old format
        if ($rows->count() > 0) {
            foreach ($rows as $row) {
                if (!is_array($row)) {
                    $row = $row->toArray();
                }
                
                // Skip empty rows
                if (empty(array_filter($row, fn($v) => $v !== null && trim($v) !== ''))) {
                    continue;
                }
                
                // Check for old format marker
                if (isset($row[2]) && strtoupper(trim((string)$row[2])) === 'PEDIDO') {
                    $colMap = [
                        'numero' => 3,      // Column D - Pedido ID
                        'articulo' => 16,   // Column Q - Articulo  
                        'cantidad' => 17,   // Column R - Cantidad
                        'precio' => 18,     // Column S - Precio unitario
                        'subtotal' => 19,   // Column T - Sub total
                        'fecha' => 21,      // Column V - Fecha
                    ];
                    break;
                }
                
                // If we find data in the first row, assume new format
                break;
            }
        }

        return $colMap;
    }
    
    private function findPedido($pedidoId)
    {
        // Try by orderId first
        $pedido = Pedidos::where('orderId', $pedidoId)->first();
        
        if (!$pedido && is_numeric($pedidoId)) {
            $pedido = Pedidos::where('orderId', (int)$pedidoId)->first();
        }
        
        // Try by nroOrder if not found
        if (!$pedido) {
            $pedido = Pedidos::where('nroOrder', $pedidoId)->first();
            if (!$pedido && is_numeric($pedidoId)) {
                $pedido = Pedidos::where('nroOrder', (int)$pedidoId)->first();
            }
        }

        return $pedido;
    }
    
    private function shouldSkipRow($row, $colMap)
    {
        // Skip completely empty lines
        $nonEmptyValues = array_filter($row, fn($v) => $v !== null && trim((string)$v) !== '');
        if (empty($nonEmptyValues)) {
            return true;
        }

        // Skip header rows
        $numeroRaw = isset($row[$colMap['numero']]) ? 
            strtolower(trim((string)$row[$colMap['numero']])) : '';
        $articuloRaw = isset($row[$colMap['articulo']]) ? 
            strtolower(trim((string)$row[$colMap['articulo']])) : '';
        
        $headerKeywords = ['numero', 'número', 'pedido', 'order', 'nro', 'articulo', 'artículo', 'producto', 'item'];
        
        if (in_array($numeroRaw, $headerKeywords) || in_array($articuloRaw, $headerKeywords)) {
            return true;
        }
        
        // For old format check
        if (isset($row[16]) && strtolower(trim((string)$row[16])) === "distrito") {
            return true;
        }

        return false;
    }
}
