<?php

namespace App\Imports;

use App\Imports\BaseImport;
use App\Models\DetailPedidos;
use App\Models\Pedidos;
use App\Services\Import\DetailPedidosImportService;
use Maatwebsite\Excel\Concerns\WithStartRow;

class DetailPedidosImport extends BaseImport implements WithStartRow
{
    protected DetailPedidosImportService $detailService;
    
    /**
     * Constructor de la clase DetailPedidosImport
     * 
     * Inicializa la instancia del servicio DetailPedidosImportService
     * que se utilizará para manejar la lógica de negocio de los detalles de pedidos.
     */
    public function __construct()
    {
        $this->detailService = new DetailPedidosImportService();
    }
    
    /**
     * Define la fila inicial para comenzar el procesamiento
     * 
     * Este método indica que el procesamiento debe comenzar desde la fila 3
     * del archivo Excel, omitiendo las primeras dos filas que generalmente
     * contienen encabezados o información no relevante.
     * 
     * @return int El número de fila inicial (3)
     */
    public function startRow(): int
    {
        return 3; // Comenzar desde la fila 3 (después de la cabecera en fila 2)
    }
    
    /**
     * Obtiene el mapeo de columnas por defecto para detalles de pedidos
     * 
     * Este método define el mapeo estándar de columnas para archivos Excel
     * que contienen detalles de pedidos, relacionando índices de columna
     * con nombres de campos específicos del sistema.
     * 
     * @return array Mapeo de columnas con índices y nombres de campos
     */
    protected function getDefaultColumnMapping(): array
    {
        return [
            'numero' => 3,            // Columna D: Numero (orderId del pedido)
            'articulo' => 16,         // Columna Q: Articulo
            'cantidad' => 17,         // Columna R: Cantidad  
            'precio_unitario' => 18,  // Columna S: PrecioUnitario
            'subtotal' => 19,         // Columna T: SubTotal
        ];
    }

    /**
     * Detect columns dynamically (supports new A..E and old D/Q/R/S/T formats)
     */
    protected function detectColumns(array $rows): array
    {
        // Default to NEW compact format (A..E => 0..4)
        $colMap = [
            'numero' => 0,
            'articulo' => 1,
            'cantidad' => 2,
            'precio_unitario' => 3,
            'subtotal' => 4,
        ];

        if (empty($rows)) {
            return $colMap;
        }

        // Heuristic: detect OLD format when col[2] says 'PEDIDO' and col[16] has article
        $maxProbe = min(10, count($rows));
        for ($i = 0; $i < $maxProbe; $i++) {
            $row = is_array($rows[$i]) ? $rows[$i] : (array)$rows[$i];
            // Skip empty rows
            if (empty(array_filter($row, fn($v) => $v !== null && trim((string)$v) !== ''))) {
                continue;
            }
            $col2 = isset($row[2]) ? strtoupper(trim((string)$row[2])) : '';
            $hasOldArticleCol = array_key_exists(16, $row) && trim((string)($row[16] ?? '')) !== '';
            if ($col2 === 'PEDIDO' && $hasOldArticleCol) {
                // Old format (D/Q/R/S/T)
                return [
                    'numero' => 3,
                    'articulo' => 16,
                    'cantidad' => 17,
                    'precio_unitario' => 18,
                    'subtotal' => 19,
                ];
            }
        }

        // Try to map by header names in second row (index 1)
        if (isset($rows[1]) && is_array($rows[1])) {
            $headers = array_map(fn($v) => is_string($v) ? strtolower(trim($v)) : $v, $rows[1]);
            $aliases = [
                'numero' => ['numero', 'número', 'pedido', 'nro', 'nro pedido'],
                'articulo' => ['articulo', 'artículo', 'producto', 'item'],
                'cantidad' => ['cantidad', 'cant'],
                'precio_unitario' => ['preciounitario', 'precio unitario', 'precio', 'p. unitario'],
                'subtotal' => ['subtotal', 'sub total', 'total linea', 'total línea'],
            ];
            foreach ($aliases as $key => $names) {
                foreach ($headers as $idx => $label) {
                    if (is_string($label) && in_array($label, $names, true)) {
                        $colMap[$key] = (int)$idx;
                        break;
                    }
                }
            }
        }

        return $colMap;
    }
    
    /**
     * Procesa una fila individual de detalles de pedido
     * 
     * Este método procesa cada fila del archivo Excel, valida los datos,
     * busca el pedido correspondiente y crea o actualiza el detalle de pedido.
     * Maneja casos especiales como pedidos preparados que no deben modificarse.
     * 
     * @param array $row La fila de datos a procesar
     * @param int $index El índice de la fila en el archivo
     * @param array $colMap El mapeo de columnas detectado
     * @return void
     */
    protected function processRow(array $row, int $index, array $colMap): void
    {
        // Skip first two header rows explicitly
        if ($index < 2) {
            $this->incrementStat('skipped');
            return;
        }
        // Skip header rows
    $numeroRaw = isset($row[$colMap['numero']]) ? strtolower(trim((string)$row[$colMap['numero']])) : '';
        if ($numeroRaw === 'numero' || $numeroRaw === 'número' || $numeroRaw === 'pedido') {
            $this->incrementStat('skipped');
            return;
        }
        
    $pedidoId = trim((string)($row[$colMap['numero']] ?? ''));
    $articulo = trim((string)($row[$colMap['articulo']] ?? ''));
    $cantidad = (float)($row[$colMap['cantidad']] ?? 0);
        $precioUnitario = isset($colMap['precio_unitario']) ? round((float)($row[$colMap['precio_unitario']] ?? 0), 2) : 0.0;
        $subtotal = isset($colMap['subtotal']) ? round((float)($row[$colMap['subtotal']] ?? 0), 2) : 0.0;
        if ($subtotal === 0.0 && $cantidad > 0 && $precioUnitario > 0) {
            $subtotal = round($cantidad * $precioUnitario, 2);
        }
        
        // Skip if essential data is missing
        if (empty($pedidoId) || empty($articulo)) {
            $this->incrementStat('errors');
            return;
        }
        
        try {
            // Find the pedido
            $pedido = $this->detailService->findPedido($pedidoId);
            if (!$pedido) {
                $this->incrementStat('errors');
                return;
            }
            
            // Skip if pedido is already prepared (productionStatus = 2)
            if ($pedido->productionStatus == 2) {
                $this->incrementStat('skipped');
                return;
            }
            
            // Check if detail already exists using pedidos_id (not pedido_id)
            $existingDetail = DetailPedidos::where('pedidos_id', $pedido->id)
                ->whereRaw('UPPER(TRIM(articulo)) = UPPER(TRIM(?))', [$articulo])
                ->first();
                
            if ($existingDetail) {
                // Normalize values for comparison (round monetary values to 3 decimals)
                $currCantidad = (float)$existingDetail->cantidad;
                $currUnit = round((float)$existingDetail->unit_prize, 2);
                $currSub = round((float)$existingDetail->sub_total, 2);
                $newUnit = round((float)$precioUnitario, 2);
                $newSub = round((float)$subtotal, 2);

                $needsUpdate = ($currCantidad != $cantidad) || (abs($currUnit - $newUnit) >= 0.005) || (abs($currSub - $newSub) >= 0.005);
                if ($needsUpdate) {
                    $existingDetail->cantidad = $cantidad;
                    $existingDetail->unit_prize = $newUnit;
                    $existingDetail->sub_total = $newSub;
                    $existingDetail->save();
                    $this->incrementStat('updated');
                } else {
                    $this->incrementStat('skipped');
                }
                return;
            }
            
            // Create new detail
            $detailData = [
                'pedidos_id' => $pedido->id,  // Note: using pedidos_id as per existing schema
                'articulo' => $articulo,
                'cantidad' => $cantidad,
                'unit_prize' => $precioUnitario,
                'sub_total' => $subtotal,
            ];
            
            $this->detailService->createDetailWithCorrectSchema($detailData);
            
            $this->incrementStat('created');
            
        } catch (\Exception $e) {
            $this->incrementStat('errors');
            // Error logged automatically by framework
        }
    }
}
