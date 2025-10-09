<?php

namespace App\Imports;

use App\Imports\BaseImport;
use App\Models\Pedidos;
use App\Models\Distritos_zonas;
use App\Application\Services\Import\PedidosImportService;
use Illuminate\Support\Facades\Auth;

class PedidosImport extends BaseImport
{
    protected PedidosImportService $pedidosService;
    
    /**
     * Constructor de la clase PedidosImport
     * 
     * Inicializa la instancia del servicio PedidosImportService
     * que se utilizará para manejar la lógica de negocio de los pedidos.
     */
    public function __construct()
    {
        $this->pedidosService = new PedidosImportService();
    }
    
    /**
     * Obtiene el mapeo de columnas por defecto para importación de pedidos
     * 
     * Este método define el mapeo estándar de columnas para archivos Excel
     * que contienen información de pedidos, incluyendo campos como orderId,
     * fechas de entrega, información del cliente, dirección, zona, visitadora, etc.
     * 
     * @return array Mapeo de columnas con índices y nombres de campos
     */
    protected function getDefaultColumnMapping(): array
    {
        return [
            0 => 'row_number',
            1 => 'fecha',
            2 => 'tipo_registro',
            3 => 'orderId',
            4 => 'customerName',
            5 => 'customerPhone_1',
            6 => 'customerPhone_2',
            7 => 'vence',
            8 => 'prize',
            9 => 'saldo',
            10 => 'paymentMethod',
            11 => 'salesStatus',
            12 => 'productionStatus',
            13 => 'deliveryDate_excel',
            14 => 'visitadora_name',
            15 => 'doctorName',
            16 => 'district',
            17 => 'address',
            18 => 'reference',
            19 => 'usuario_nombre',
            20 => 'fecha_registro',
            21 => 'cpe_codigo',
            22 => 'cpe_fecha',
            23 => 'status_text',
        ];
    }
    
    /**
     * Procesa una fila individual de datos de pedido
     * 
     * Este método procesa cada fila del archivo Excel, valida que sea un registro
     * de pedido, verifica que no exista ya en la base de datos, convierte las fechas,
     * busca las entidades relacionadas (zona, visitadora) y crea el nuevo pedido.
     * 
     * @param array $row La fila de datos a procesar
     * @param int $index El índice de la fila en el archivo
     * @param array $colMap El mapeo de columnas detectado
     * @return void
     */
    protected function processRow(array $row, int $index, array $colMap): void
    {
        // Validate row data
        if (!$this->pedidosService->validatePedidoData($row)) {
            $this->incrementStat('skipped');
            return;
        }
        
        $orderId = trim($row[$colMap['orderId']] ?? '');
        
        // Check if pedido already exists
        if ($this->pedidosService->pedidoExists($orderId)) {
            $this->incrementStat('skipped');
            return;
        }
        
        try {
            // Convert Excel date
            $deliveryDate = $this->pedidosService->convertExcelDate($row[$colMap['deliveryDate_excel']])
                ->format('Y-m-d');

            // Get next order number
            $nroOrder = $this->pedidosService->getNextOrderNumber($deliveryDate);

            $district = trim($row[$colMap['district']] ?? '');
            $zoneId = $district !== '' ? Distritos_zonas::zonificar($district) : null;

            $visitadora = null;
            if (!empty($row[$colMap['visitadora_name']] ?? '')) {
                $visitadora = $this->pedidosService->findVisitadora($row[$colMap['visitadora_name']]);
            }

            $status = $this->pedidosService->mapExcelStatus($row[$colMap['status_text']] ?? null);

            // Prepare pedido data
            $pedidoData = [
                'orderId' => $orderId,
                'nroOrder' => $nroOrder,
                'deliveryDate' => $deliveryDate,
                'customerName' => trim($row[$colMap['customerName']] ?? ''),
                'customerNumber' => trim($row[$colMap['customerPhone_1']] ?? ''),
                'doctorName' => trim($row[$colMap['doctorName']] ?? ''),
                'address' => trim($row[$colMap['address']] ?? ''),
                'district' => $district,
                'reference' => trim($row[$colMap['reference']] ?? ''),
                'prize' => floatval($row[$colMap['prize']] ?? 0),
                'zone_id' => $zoneId,
                'visitadora_id' => $visitadora?->id,
                'paymentMethod' => trim($row[$colMap['paymentMethod']] ?? ''),
                'status' => $status,
                'productionStatusExcel' => trim($row[$colMap['productionStatus']] ?? ''),
                'user_id' => Auth::id(),
            ];

            // Create pedido
            $pedido = $this->pedidosService->createPedido($pedidoData);

            $this->incrementStat('created');

        } catch (\Exception $e) {
            $this->incrementStat('errors');
            // Error logged automatically by framework
        }
    }
}
