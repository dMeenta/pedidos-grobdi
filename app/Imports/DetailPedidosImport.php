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
        $precioUnitario = (float)($row[$colMap['precio_unitario']] ?? 0);
        $subtotal = (float)($row[$colMap['subtotal']] ?? 0);
        
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
                // Check if needs update
                if ($existingDetail->cantidad != $cantidad || 
                    $existingDetail->unit_prize != $precioUnitario || 
                    $existingDetail->sub_total != $subtotal) {
                    
                    $existingDetail->cantidad = $cantidad;
                    $existingDetail->unit_prize = $precioUnitario;
                    $existingDetail->sub_total = $subtotal;
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
