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
     * Este método indica que el procesamiento debe comenzar desde la fila 2
     * del archivo Excel para poder leer las cabeceras en la fila 2.
     * 
     * @return int El número de fila inicial (2)
     */
    public function startRow(): int
    {
        return 2; // Comenzar desde la fila 2 para incluir cabeceras
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
     * Detecta columnas dinámicamente (soporta formatos nuevo A..E y antiguo D/Q/R/S/T)
     */
    protected function detectColumns(array $rows): array
    {
        // Por defecto, usar el formato NUEVO compacto (A..E => 0..4)
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

        // Intentar mapear por nombres de encabezado en la primera fila (índice 0, que es la fila 2 de Excel)
        if (isset($rows[0]) && is_array($rows[0])) {
            $headers = array_map(fn($v) => is_string($v) ? strtolower(trim($v)) : $v, $rows[0]);
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
        // Omitir la fila de encabezado (índice 0 = fila 2 en Excel)
        if ($index < 1) {
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
        
        // Omitir si faltan datos esenciales
        if (empty($pedidoId) || empty($articulo)) {
            $this->incrementStat('errors');
            return;
        }
        
        try {
            // Buscar el pedido
            $pedido = $this->detailService->findPedido($pedidoId);
            if (!$pedido) {
                $this->incrementStat('errors');
                return;
            }
            
            // Omitir si el pedido ya está preparado (productionStatus = 2)
            if ($pedido->productionStatus == 2) {
                $this->incrementStat('skipped');
                return;
            }
            
            // Verificar si el detalle ya existe usando pedidos_id (no pedido_id)
            // Regla: solo omitir si ya existe un detalle con el MISMO artículo + cantidad + precio.
            // Si alguno de estos difiere, crear un NUEVO detalle (NO actualizar el existente).
            $newUnit = round((float)$precioUnitario, 2);
            $newSub = round((float)$subtotal, 2);

            $exactExists = DetailPedidos::where('pedidos_id', $pedido->id)
                ->whereRaw('UPPER(TRIM(articulo)) = UPPER(TRIM(?))', [$articulo])
                ->where('cantidad', $cantidad)
                ->whereRaw('ROUND(unit_prize, 2) = ?', [$newUnit])
                ->exists();

            if ($exactExists) {
                // La misma línea exacta ya existe -> omitir
                $this->incrementStat('skipped');
                return;
            }

            // Crear nuevo detalle (difiere cantidad o precio o no existe)
            $detailData = [
                'pedidos_id' => $pedido->id,  // Nota: usando pedidos_id según el esquema existente
                'articulo' => $articulo,
                'cantidad' => $cantidad,
                'unit_prize' => $newUnit,
                'sub_total' => $newSub,
            ];
            
            $this->detailService->createDetailWithCorrectSchema($detailData);
            
            $this->incrementStat('created');
            
        } catch (\Exception $e) {
            $this->incrementStat('errors');
            // El error se registra automáticamente por el framework
        }
    }
}
