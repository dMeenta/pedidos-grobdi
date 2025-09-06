<?php

namespace App\Services\Import;

use App\Models\DetailPedidos;
use App\Models\Pedidos;
use App\Models\Articulo;
use Illuminate\Support\Collection;

class DetailPedidosImportService
{
    /**
     * Busca un pedido por su ID de orden
     * 
     * Este método busca en la base de datos un pedido específico utilizando
     * su identificador único de orden (orderId). Retorna null si no encuentra
     * el pedido correspondiente.
     * 
     * @param string $orderId El identificador único de la orden
     * @return Pedidos|null El pedido encontrado o null si no existe
     */
    public function findPedido(string $orderId): ?Pedidos
    {
        return Pedidos::where('orderId', $orderId)->first();
    }
    
    /**
     * Busca un artículo por su nombre
     * 
     * Este método busca en la base de datos un artículo específico utilizando
     * su nombre como criterio de búsqueda. Retorna null si no encuentra
     * el artículo correspondiente.
     * 
     * @param string $name El nombre del artículo a buscar
     * @return Articulo|null El artículo encontrado o null si no existe
     */
    public function findArticulo(string $name): ?Articulo
    {
        return Articulo::where('name', $name)->first();
    }
    
    /**
     * Verifica si ya existe un detalle de pedido
     * 
     * Este método comprueba si ya existe un registro de detalle de pedido
     * para una combinación específica de pedido y artículo. Esto ayuda a
     * evitar duplicados durante el proceso de importación.
     * 
     * @param int $pedidoId El ID del pedido
     * @param int $articuloId El ID del artículo
     * @return bool True si el detalle ya existe, false en caso contrario
     */
    public function detailExists(int $pedidoId, int $articuloId): bool
    {
        return DetailPedidos::where('pedido_id', $pedidoId)
            ->where('articulo_id', $articuloId)
            ->exists();
    }
    
    /**
     * Obtiene un detalle de pedido existente
     * 
     * Este método recupera un registro específico de detalle de pedido
     * basado en la combinación de ID de pedido y ID de artículo.
     * Retorna null si no encuentra el registro.
     * 
     * @param int $pedidoId El ID del pedido
     * @param int $articuloId El ID del artículo
     * @return DetailPedidos|null El detalle encontrado o null si no existe
     */
    public function getExistingDetail(int $pedidoId, int $articuloId): ?DetailPedidos
    {
        return DetailPedidos::where('pedido_id', $pedidoId)
            ->where('articulo_id', $articuloId)
            ->first();
    }
    
    /**
     * Crea un nuevo detalle de pedido
     * 
     * Este método crea un nuevo registro de detalle de pedido con los datos
     * proporcionados. Calcula automáticamente el subtotal si no se proporciona,
     * multiplicando la cantidad por el precio unitario.
     * 
     * @param array $data Array con los datos del detalle ['pedido_id', 'articulo_id', 'cantidad', 'precio_unitario', 'subtotal']
     * @return DetailPedidos El detalle de pedido creado
     */
    public function createDetailPedido(array $data): DetailPedidos
    {
        $detail = new DetailPedidos();
        
        $detail->pedido_id = $data['pedido_id'];
        $detail->articulo_id = $data['articulo_id'];
        $detail->cantidad = $data['cantidad'];
        $detail->precio_unitario = $data['precio_unitario'] ?? 0;
        $detail->subtotal = $data['subtotal'] ?? ($data['cantidad'] * ($data['precio_unitario'] ?? 0));
        
        $detail->save();
        
        return $detail;
    }
    
    /**
     * Actualiza un detalle de pedido existente
     * 
     * Este método actualiza los datos de un detalle de pedido existente con
     * la nueva información proporcionada. Recalcula el subtotal basado en
     * la cantidad y precio unitario actualizados.
     * 
     * @param DetailPedidos $detail El detalle de pedido a actualizar
     * @param array $data Array con los nuevos datos ['cantidad', 'precio_unitario', 'subtotal']
     * @return DetailPedidos El detalle de pedido actualizado
     */
    public function updateDetailPedido(DetailPedidos $detail, array $data): DetailPedidos
    {
        $detail->cantidad = $data['cantidad'];
        $detail->precio_unitario = $data['precio_unitario'] ?? $detail->precio_unitario;
        $detail->subtotal = $data['subtotal'] ?? ($data['cantidad'] * $detail->precio_unitario);
        
        $detail->save();
        
        return $detail;
    }
    
    /**
     * Detecta el mapeo de columnas desde datos de muestra
     * 
     * Este método analiza las filas de datos para determinar automáticamente
     * el formato y mapeo de columnas del archivo Excel. Detecta diferentes
     * formatos basándose en la presencia de palabras clave como "ARTICULO"
     * en posiciones específicas, permitiendo manejar múltiples formatos
     * de archivo de importación.
     * 
     * @param Collection $rows Colección de filas de datos de muestra
     * @return array Mapeo de columnas detectado con índices y nombres de campos
     */
    public function detectColumns(Collection $rows): array
    {
        $defaultMapping = [
            0 => 'campo0',
            1 => 'campo1',
            2 => 'tipo_registro', 
            3 => 'orderId',
            4 => 'campo4',
            5 => 'campo5',
            6 => 'campo6',
            7 => 'campo7',
            8 => 'campo8',
            9 => 'campo9',
            10 => 'campo10',
            11 => 'campo11',
            12 => 'campo12',
            13 => 'campo13',
            14 => 'campo14',
            15 => 'campo15',
            16 => 'articulo_name',
            17 => 'cantidad',
            18 => 'precio_unitario',
        ];
        
        // Try to detect format by checking first few rows
        foreach ($rows->take(10) as $row) {
            if (!is_array($row)) {
                $row = $row->toArray();
            }
            
            // If row has "ARTICULO" in specific position, it's likely format 2
            if (isset($row[16]) && strtoupper($row[16]) === 'ARTICULO') {
                return [
                    0 => 'campo0',
                    1 => 'campo1', 
                    2 => 'tipo_registro',
                    3 => 'orderId',
                    16 => 'articulo_name',
                    17 => 'cantidad',
                    18 => 'precio_unitario',
                ];
            }
            
            // Check for format 1 (shorter columns)
            if (isset($row[5]) && !isset($row[16])) {
                return [
                    0 => 'tipo_registro',
                    1 => 'orderId', 
                    2 => 'articulo_name',
                    3 => 'cantidad',
                    4 => 'precio_unitario',
                ];
            }
        }
        
        return $defaultMapping;
    }
    
    /**
     * Valida los datos de una fila
     * 
     * Este método verifica que una fila contenga datos válidos para un
     * registro de artículo. Comprueba que sea una fila de tipo "ARTICULO"
     * y que contenga los campos requeridos (orderId, articulo_name, cantidad).
     * 
     * @param array $row La fila de datos a validar
     * @param array $colMap El mapeo de columnas actual
     * @return bool True si la fila es válida, false en caso contrario
     */
    public function validateRowData(array $row, array $colMap): bool
    {
        // Skip if not an ARTICULO row
        if (($row[$colMap['tipo_registro']] ?? '') !== 'ARTICULO') {
            return false;
        }
        
        // Check required fields
        return !empty($row[$colMap['orderId']] ?? '') && 
               !empty($row[$colMap['articulo_name']] ?? '') && 
               !empty($row[$colMap['cantidad']] ?? '');
    }
    
    /**
     * Actualiza el total de un pedido
     * 
     * Este método recalcula y actualiza el total de un pedido sumando
     * todos los subtotales de sus detalles asociados. Es útil después
     * de agregar, modificar o eliminar detalles de un pedido.
     * 
     * @param int $pedidoId El ID del pedido a actualizar
     * @return void
     */
    public function updatePedidoTotal(int $pedidoId): void
    {
        $pedido = Pedidos::find($pedidoId);
        if ($pedido) {
            $total = DetailPedidos::where('pedido_id', $pedidoId)->sum('subtotal');
            $pedido->total = $total;
            $pedido->save();
        }
    }
    
    /**
     * Valida los datos de un detalle
     * 
     * Este método verifica que los datos de un detalle de pedido sean válidos.
     * Comprueba que no sea una fila de encabezado y que contenga los campos
     * requeridos (numero y articulo) con valores no vacíos.
     * 
     * @param array $row La fila de datos a validar
     * @param array $colMap El mapeo de columnas actual
     * @return bool True si los datos son válidos, false en caso contrario
     */
    public function validateDetailData(array $row, array $colMap): bool
    {
        // Check for header row - buscar en la columna de artículo
        $articuloRaw = isset($row[$colMap['articulo']]) ? strtolower(trim((string)$row[$colMap['articulo']])) : '';
        if ($articuloRaw === 'articulo' || $articuloRaw === 'artículo') {
            return false;
        }
        
        // También verificar la columna numero por si es header
        $numeroRaw = isset($row[$colMap['numero']]) ? strtolower(trim((string)$row[$colMap['numero']])) : '';
        if ($numeroRaw === 'numero' || $numeroRaw === 'número' || $numeroRaw === 'pedido') {
            return false;
        }
        
        // Must have numero and articulo (y que articulo no esté vacío)
        return !empty(trim($row[$colMap['numero']] ?? '')) && 
               !empty(trim($row[$colMap['articulo']] ?? ''));
    }
    
    /**
     * Parsea un valor numérico desde una cadena
     * 
     * Este método limpia una cadena de texto removiendo caracteres no numéricos
     * (excepto el punto decimal) y la convierte a un valor flotante. Es útil
     * para procesar datos numéricos que pueden contener formato de moneda
     * u otros caracteres especiales.
     * 
     * @param string $value La cadena que contiene el valor numérico
     * @return float El valor numérico parseado
     */
    public function parseNumericValue(string $value): float
    {
        // Remove any non-numeric characters except decimal point
        $cleaned = preg_replace('/[^\d.]/', '', trim($value));
        
        // Convert to float
        return (float) $cleaned;
    }
    
    /**
     * Crea un detalle con los datos proporcionados
     * 
     * Este método crea un nuevo registro de detalle de pedido con la información
     * básica proporcionada, incluyendo timestamps automáticos para created_at
     * y updated_at. Utiliza el esquema estándar de la base de datos.
     * 
     * @param array $data Array con los datos del detalle ['pedido_id', 'articulo', 'cantidad', 'precio_unitario', 'precio_total', 'observaciones']
     * @return DetailPedidos El detalle de pedido creado
     */
    public function createDetail(array $data): DetailPedidos
    {
        $detail = new DetailPedidos();
        
        // Set basic information
        $detail->pedido_id = $data['pedido_id'];
        $detail->articulo = $data['articulo'];
        $detail->cantidad = $data['cantidad'];
        $detail->precio_unitario = $data['precio_unitario'];
        $detail->precio_total = $data['precio_total'];
        $detail->observaciones = $data['observaciones'];
        
        // Set timestamps
        $detail->created_at = now();
        $detail->updated_at = now();
        
        $detail->save();
        
        return $detail;
    }
    
    /**
     * Crea un detalle con el esquema correcto de la base de datos
     * 
     * Este método crea un nuevo registro de detalle de pedido utilizando el
     * esquema correcto de la base de datos, con los nombres de campos precisos
     * (pedidos_id en lugar de pedido_id, unit_prize en lugar de precio_unitario,
     * sub_total en lugar de precio_total). Incluye timestamps automáticos.
     * 
     * @param array $data Array con los datos usando nombres correctos ['pedidos_id', 'articulo', 'cantidad', 'unit_prize', 'sub_total']
     * @return DetailPedidos El detalle de pedido creado con esquema correcto
     */
    public function createDetailWithCorrectSchema(array $data): DetailPedidos
    {
        $detail = new DetailPedidos();
        
        // Set basic information using the correct schema
        $detail->pedidos_id = $data['pedidos_id'];  // Note: pedidos_id not pedido_id
        $detail->articulo = $data['articulo'];
        $detail->cantidad = $data['cantidad'];
        $detail->unit_prize = $data['unit_prize'];  // Note: unit_prize not precio_unitario
        $detail->sub_total = $data['sub_total'];    // Note: sub_total not precio_total
        
        // Set timestamps
        $detail->created_at = now();
        $detail->updated_at = now();
        
        $detail->save();
        
        return $detail;
    }
}
