<?php

namespace App\Imports;

use App\Models\DetailPedidos;
use App\Models\Pedidos;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;

class DetailPedidosPreviewImport implements ToCollection
{
    public $data;
    public $key;
    public $changes = [];
    public $stats = [];

    public function collection(Collection $rows)
    {
        $this->initializeCounters();
        $this->changes = [
            'new' => [],
            'modified' => [],
            'no_changes' => [],
            'not_found' => [],
            'prepared_orders' => [],
            'duplicates' => [],
            'stats' => []
        ];

        // Convert collection to array with preserved keys for better handling
        $originalRows = $rows->toArray();
        
        $colMap = $this->detectColumns($originalRows);
        $processedRows = $this->detectDuplicates($originalRows, $colMap);

        // Store duplicates information but DON'T stop processing
        if ($processedRows['has_duplicates']) {
            // Debug: Log what duplicates were found
            Log::info('Duplicates detected', [
                'count' => count($processedRows['duplicates']),
                'duplicates' => $processedRows['duplicates']
            ]);
            
            $this->changes['duplicates'] = $processedRows['duplicates'];
            // Don't return here - continue processing to show preview with duplicates highlighted
        }

        foreach ($originalRows as $rowIndex => $row) {
            $this->processRow($row, $rowIndex, $colMap);
        }

        $this->finalizeResults();
    }

    private function initializeCounters()
    {
        $this->stats = [
            'new_count' => 0,
            'modified_count' => 0,
            'no_changes_count' => 0,
            'not_found_count' => 0,
            'prepared_orders_count' => 0,
            'total_count' => 0
        ];
    }

    private function detectColumns(array $rows)
    {
        // Default column mapping for the new Excel format (0-4) and old format compatibility
        $colMap = [
            'numero' => 0,      // Column A - Numero de pedido
            'articulo' => 1,    // Column B - Articulo
            'cantidad' => 2,    // Column C - Cantidad
            'precio' => 3,      // Column D - Precio unitario
            'subtotal' => 4,    // Column E - Sub total
        ];

        // Check if we're dealing with the old format (where data starts at different columns)
        if (count($rows) > 0) {
            $firstDataRow = null;
            
            // Find the first data row (skip headers)
            foreach ($rows as $row) {
                if (!is_array($row)) {
                    $row = $row->toArray();
                }
                
                // Skip empty rows
                if (empty(array_filter($row, fn($v) => $v !== null && trim((string)$v) !== ''))) {
                    continue;
                }
                
                // Check if this might be a header row
                $firstCol = isset($row[0]) ? strtolower(trim((string)$row[0])) : '';
                $thirdCol = isset($row[2]) ? strtolower(trim((string)$row[2])) : '';
                
                if (in_array($firstCol, ['numero', 'número', 'pedido', 'nro']) || 
                    in_array($thirdCol, ['pedido', 'numero', 'número'])) {
                    continue; // Skip header row
                }
                
                $firstDataRow = $row;
                break;
            }
            
            // Check if we're using the old format (column 2 = "PEDIDO", column 3 = pedido ID)
            if ($firstDataRow && isset($firstDataRow[2]) && 
                strtoupper(trim((string)$firstDataRow[2])) === 'PEDIDO') {
                
                Log::info('Detected old Excel format', [
                    'sample_row' => array_slice($firstDataRow, 0, 25) // Show first 25 columns for debugging
                ]);
                
                $colMap = [
                    'numero' => 3,      // Column D - Pedido ID (after "PEDIDO")
                    'articulo' => 16,   // Column Q - Articulo
                    'cantidad' => 17,   // Column R - Cantidad
                    'precio' => 18,     // Column S - Precio unitario  
                    'subtotal' => 19,   // Column T - Sub total
                ];
            } else {
                Log::info('Using new Excel format', [
                    'sample_row' => $firstDataRow ? array_slice($firstDataRow, 0, 10) : 'NO_DATA_ROW_FOUND'
                ]);
            }
        }

        return $colMap;
    }

    private function detectDuplicates(array $rows, array $colMap)
    {
        $seen = [];
        $duplicates = [];
        $has_duplicates = false;

        foreach ($rows as $rowIndex => $row) {
            if (!is_array($row)) { 
                $row = $row->toArray(); 
            }

            // Skip empty lines and headers
            if ($this->shouldSkipRow($row, $colMap)) {
                continue;
            }

            // Read using detected column map only
            $pedidoIdRaw = isset($row[$colMap['numero']]) ? trim((string)$row[$colMap['numero']]) : '';
            $articulo = isset($row[$colMap['articulo']]) ? trim((string)$row[$colMap['articulo']]) : '';
            $cantidad = isset($row[$colMap['cantidad']]) ? (float)$row[$colMap['cantidad']] : 0;
            $precio = isset($row[$colMap['precio']]) ? round((float)$row[$colMap['precio']], 3) : 0;
            
            // Debug logging for specific problematic rows
            if ($rowIndex >= 9 && $rowIndex <= 11) {
                Log::info('Debugging specific row data', [
                    'row_index' => $rowIndex,
                    'raw_row_data' => $row,
                    'colMap' => $colMap,
                    'extracted_numero' => $pedidoIdRaw,
                    'extracted_articulo' => $articulo,
                    'extracted_cantidad' => $cantidad,
                    'extracted_precio' => $precio,
                    'raw_cantidad_value' => isset($row[$colMap['cantidad']]) ? $row[$colMap['cantidad']] : 'NOT_SET',
                    'raw_precio_value' => isset($row[$colMap['precio']]) ? $row[$colMap['precio']] : 'NOT_SET'
                ]);
            }
            
            // Skip rows with missing critical data
            if (empty($pedidoIdRaw) || empty($articulo)) {
                continue;
            }

            // Log what we're processing for debugging
            Log::info('Processing row for duplicates', [
                'row_index' => $rowIndex,
                'pedido_id' => $pedidoIdRaw,
                'articulo' => $articulo,
                'cantidad' => $cantidad,
                'precio' => $precio,
                'col_map' => $colMap
            ]);

            // Create unique key including pedido + articulo + cantidad + precio
            // Two rows are only duplicates if ALL these values are exactly the same
            $normalizedKey = strtoupper(trim($pedidoIdRaw)) . '|' . 
                           strtoupper(trim($articulo)) . '|' . 
                           $cantidad . '|' . 
                           $precio;
            
            Log::info('Generated duplicate key', [
                'row_index' => $rowIndex,
                'normalizedKey' => $normalizedKey,
                'pedido_raw' => $pedidoIdRaw,
                'articulo' => $articulo,
                'cantidad' => $cantidad,
                'precio' => $precio
            ]);
            
            if (isset($seen[$normalizedKey])) {
                $has_duplicates = true;
                
                Log::info('Duplicate found!', [
                    'key' => $normalizedKey,
                    'original_row' => $seen[$normalizedKey] + 1,
                    'duplicate_row' => $rowIndex + 1,
                    'pedido_id' => $pedidoIdRaw,
                    'articulo' => $articulo,
                    'cantidad' => $cantidad,
                    'precio' => $precio
                ]);
                
                // Add original row if not already in duplicates
                $originalRowIndex = $seen[$normalizedKey];
                $alreadyAdded = false;
                foreach ($duplicates as $dup) {
                    if ($dup['row_index'] === ($originalRowIndex + 1)) {
                        $alreadyAdded = true;
                        break;
                    }
                }
                
                if (!$alreadyAdded) {
                    $duplicates[] = $this->formatDuplicateRow($rows[$originalRowIndex], $originalRowIndex + 1, $colMap);
                }
                
                // Add current duplicate
                $duplicates[] = $this->formatDuplicateRow($row, $rowIndex + 1, $colMap);
            } else {
                $seen[$normalizedKey] = $rowIndex;
            }
        }

        Log::info('Duplicate detection results', [
            'has_duplicates' => $has_duplicates,
            'duplicate_count' => count($duplicates)
        ]);

        return [
            'has_duplicates' => $has_duplicates,
            'duplicates' => $duplicates
        ];
    }

    private function formatDuplicateRow(array $row, int $rowIndex, array $colMap)
    {
        $pedidoId = isset($row[$colMap['numero']]) ? trim((string)$row[$colMap['numero']]) : '';
        $articulo = isset($row[$colMap['articulo']]) ? trim((string)$row[$colMap['articulo']]) : '';
        $cantidad = isset($row[$colMap['cantidad']]) ? (float)$row[$colMap['cantidad']] : 0;
        $precio = isset($row[$colMap['precio']]) ? round((float)$row[$colMap['precio']], 3) : 0;
        $subtotal = isset($row[$colMap['subtotal']]) ? round((float)$row[$colMap['subtotal']], 3) : 0;
        
        return [
            'row_index' => $rowIndex,
            'pedido_id' => $pedidoId,
            'articulo' => $articulo,
            'cantidad' => $cantidad,
            'unit_prize' => $precio,
            'sub_total' => $subtotal,
            'duplicate_key' => strtoupper(trim($pedidoId)) . '|' . strtoupper(trim($articulo)) . '|' . $cantidad . '|' . $precio,
            'raw_data_preview' => [
                'col_' . $colMap['numero'] => isset($row[$colMap['numero']]) ? $row[$colMap['numero']] : 'N/A',
                'col_' . $colMap['articulo'] => isset($row[$colMap['articulo']]) ? $row[$colMap['articulo']] : 'N/A',  
                'col_' . $colMap['cantidad'] => isset($row[$colMap['cantidad']]) ? $row[$colMap['cantidad']] : 'N/A',
                'col_' . $colMap['precio'] => isset($row[$colMap['precio']]) ? $row[$colMap['precio']] : 'N/A'
            ]
        ];
    }


    private function shouldSkipRow(array $row, array $colMap)
    {
        // Skip completely empty lines
        $nonEmptyValues = array_filter($row, fn($v) => $v !== null && trim((string)$v) !== '');
        if (empty($nonEmptyValues)) {
            return true;
        }

        // Skip header rows - check for header keywords in multiple columns
        $numeroRaw = isset($row[$colMap['numero']]) ? 
            strtolower(trim((string)$row[$colMap['numero']])) : '';
        $articuloRaw = isset($row[$colMap['articulo']]) ? 
            strtolower(trim((string)$row[$colMap['articulo']])) : '';
        
        $headerKeywords = ['numero', 'número', 'pedido', 'order', 'nro', 'articulo', 'artículo', 'producto', 'item'];
        
        // If pedido column contains header keywords OR articulo column contains header keywords
        if (in_array($numeroRaw, $headerKeywords) || in_array($articuloRaw, $headerKeywords)) {
            return true;
        }
        
        // For old format, check if column 2 contains "PEDIDO" but column 3 is header-like
        if (isset($row[2]) && strtoupper(trim((string)$row[2])) === 'PEDIDO') {
            $col3 = isset($row[3]) ? strtolower(trim((string)$row[3])) : '';
            if (in_array($col3, ['numero', 'número', 'pedido', 'order', 'nro'])) {
                return true;
            }
        }

        return false;
    }

    private function processRow($row, int $rowIndex, array $colMap)
    {
        if (!is_array($row)) { 
            $row = $row->toArray(); 
        }

        if ($this->shouldSkipRow($row, $colMap)) {
            return;
        }

    // Extract and validate data using detected columns
    $pedidoIdRaw = isset($row[$colMap['numero']]) ? trim((string)$row[$colMap['numero']]) : '';
    $articulo    = isset($row[$colMap['articulo']]) ? trim((string)$row[$colMap['articulo']]) : '';
    $cantidad    = isset($row[$colMap['cantidad']]) ? (float)$row[$colMap['cantidad']] : 0;
        
        // Skip rows with empty critical data
        if (empty($pedidoIdRaw) || empty($articulo) || $cantidad <= 0) {
            return;
        }

        $this->stats['total_count']++;

        $pedido = $this->findPedido($pedidoIdRaw);
        
        if (!$pedido) {
            $this->stats['not_found_count']++;
            $this->changes['not_found'][] = [
                'row_index' => $rowIndex + 1,
                'pedido_id' => $pedidoIdRaw,
                'articulo' => $articulo,
            ];
            return;
        }

        // Check if order is prepared (status 2)
        if ($pedido->productionStatus === 2) {
            $this->stats['prepared_orders_count']++;
            $this->changes['prepared_orders'][] = [
                'row_index' => $rowIndex + 1,
                'pedido_id' => $pedido->orderId ?? $pedido->nroOrder,
                'articulo' => $articulo,
            ];
            return;
        }

    $this->processArticle($row, $rowIndex, $colMap, $pedido);
    }

    private function findPedido(string $pedidoIdRaw)
    {
        // Try by orderId
        $pedido = Pedidos::where('orderId', $pedidoIdRaw)->first();
        if (!$pedido && is_numeric($pedidoIdRaw)) {
            $pedido = Pedidos::where('orderId', (int)$pedidoIdRaw)->first();
        }
        
        // Try by nroOrder if not found
        if (!$pedido) {
            $pedido = Pedidos::where('nroOrder', $pedidoIdRaw)->first();
            if (!$pedido && is_numeric($pedidoIdRaw)) {
                $pedido = Pedidos::where('nroOrder', (int)$pedidoIdRaw)->first();
            }
        }

        return $pedido;
    }

    private function processArticle(array $row, int $rowIndex, array $colMap, $pedido)
    {
        $articulo = isset($row[$colMap['articulo']]) ? trim((string)$row[$colMap['articulo']]) : '';
        $cantidad = isset($row[$colMap['cantidad']]) ? (float)$row[$colMap['cantidad']] : 0;
        $unit = isset($row[$colMap['precio']]) && $row[$colMap['precio']] !== '' ? 
            round((float)$row[$colMap['precio']], 3) : 0.0;
        $sub = isset($row[$colMap['subtotal']]) && $row[$colMap['subtotal']] !== '' ? 
            round((float)$row[$colMap['subtotal']], 3) : 
            round($cantidad * $unit, 3);

        // Find existing article in database using case-insensitive comparison
        $existing = DetailPedidos::where('pedidos_id', $pedido->id)
            ->whereRaw('UPPER(TRIM(articulo)) = UPPER(TRIM(?))', [$articulo])
            ->first();

        if (!$existing) {
            $this->addNewArticle($row, $rowIndex, $colMap, $pedido, $articulo, $cantidad, $unit, $sub);
        } else {
            $this->checkModifications($row, $rowIndex, $colMap, $pedido, $existing, $cantidad, $unit, $sub);
        }
    }

    private function addNewArticle($row, int $rowIndex, array $colMap, $pedido, string $articulo, float $cantidad, float $unit, float $sub)
    {
        $this->stats['new_count']++;
        $this->changes['new'][] = [
            'row_index' => $rowIndex + 1,
            'data' => [
                'pedido_id' => $pedido->orderId ?? $pedido->nroOrder,
                'pedido_cliente' => $pedido->customer_name ?? 'N/A',
                'articulo' => $articulo,
                'cantidad' => $cantidad,
                'unit_prize' => $unit,
                'sub_total' => $sub,
            ]
        ];
    }

    private function checkModifications($row, int $rowIndex, array $colMap, $pedido, $existing, float $cantidad, float $unit, float $sub)
    {
        $modifications = [];

        if ((float)$existing->cantidad != $cantidad) {
            $modifications[] = [
                'field' => 'cantidad',
                'label' => 'Cantidad',
                'old_value' => (float)$existing->cantidad,
                'new_value' => $cantidad,
            ];
        }

        if (round((float)$existing->unit_prize, 3) !== $unit) {
            $modifications[] = [
                'field' => 'unit_prize', 
                'label' => 'Precio Unitario',
                'old_value' => 'S/ ' . round((float)$existing->unit_prize, 3),
                'new_value' => 'S/ ' . $unit,
            ];
        }

        if (round((float)$existing->sub_total, 3) !== $sub) {
            $modifications[] = [
                'field' => 'sub_total',
                'label' => 'Sub Total',
                'old_value' => 'S/ ' . round((float)$existing->sub_total, 3),
                'new_value' => 'S/ ' . $sub,
            ];
        }

        if (!empty($modifications)) {
            $this->stats['modified_count']++;
            $this->changes['modified'][] = [
                'row_index' => $rowIndex + 1,
                'pedido_id' => $pedido->orderId ?? $pedido->nroOrder,
                'modifications' => $modifications,
                'existing' => [
                    'pedido_id' => $pedido->orderId ?? $pedido->nroOrder,
                    'pedido_cliente' => $pedido->customer_name ?? 'N/A',
                    'articulo' => $existing->articulo,
                    'cantidad' => (float)$existing->cantidad,
                    'unit_prize' => round((float)$existing->unit_prize, 3),
                    'sub_total' => round((float)$existing->sub_total, 3),
                    'last_data_update' => $existing->updated_at ? $existing->updated_at->format('Y-m-d H:i:s') : 'N/A',
                ],
                'new' => [
                    'pedido_id' => $pedido->orderId ?? $pedido->nroOrder,
                    'pedido_cliente' => $pedido->customer_name ?? 'N/A',
                    'articulo' => trim((string)$row[$colMap['articulo']]),
                    'cantidad' => $cantidad,
                    'unit_prize' => $unit,
                    'sub_total' => $sub,
                ]
            ];
        } else {
            $this->stats['no_changes_count']++;
            $this->changes['no_changes'][] = [
                'row_index' => $rowIndex + 1,
                'pedido_id' => $pedido->orderId ?? $pedido->nroOrder,
                'articulo' => $existing->articulo,
            ];
        }
    }

    private function finalizeResults()
    {
        $this->changes['stats'] = $this->stats;

        $processedSum = $this->stats['new_count'] + $this->stats['modified_count'] + 
                        $this->stats['no_changes_count'] + $this->stats['not_found_count'] + 
                        $this->stats['prepared_orders_count'];

        // If nothing processed but there are duplicates detected, still return preview so user can correct Excel
        if ($processedSum === 0 && !empty($this->changes['duplicates'])) {
            $this->changes['info_message'] = 'Solo se detectaron filas duplicadas. Revisa la tabla de duplicados para corregir tu Excel.';
            $this->data = $this->changes;
            $this->key = 'warning';
            return;
        }

        if ($processedSum === 0) {
            $this->data = 'No se encontraron filas válidas para procesar en el archivo de artículos.';
            $this->key = 'warning';
            return;
        }

        // Generate summary
        $summary = "RESUMEN DE PROCESAMIENTO:\n";
        $summary .= "Artículos nuevos: {$this->stats['new_count']}\n";
        $summary .= "Artículos modificados: {$this->stats['modified_count']}\n";
        $summary .= "Sin cambios: {$this->stats['no_changes_count']}\n";
        $summary .= "Pedidos no encontrados: {$this->stats['not_found_count']}\n";
        $summary .= "Pedidos preparados (sin cambios): {$this->stats['prepared_orders_count']}\n";
        $summary .= "Total filas procesadas: {$this->stats['total_count']}\n";

        $this->data = $this->changes;
        
        if ($this->stats['new_count'] + $this->stats['modified_count'] > 0) {
            $this->key = $this->stats['not_found_count'] > 0 ? 'warning' : 'success';
        } else {
            $this->key = $this->stats['not_found_count'] > 0 ? 'warning' : 'info';
        }
    }
}