<?php

namespace App\Traits\Import;

use Carbon\Carbon;

trait HasDataValidation
{
    /**
     * Valida que los campos requeridos estén presentes y no estén vacíos
     * 
     * Este método verifica que todos los campos marcados como requeridos
     * existan en la fila de datos y contengan valores no vacíos. Es crucial
     * para asegurar la integridad de los datos antes de procesarlos.
     * 
     * @param array $row La fila de datos a validar
     * @param array $requiredFields Array con los nombres de los campos requeridos
     * @param array $colMap Mapeo de columnas que relaciona nombres con índices
     * @return bool True si todos los campos requeridos son válidos, false en caso contrario
     */
    protected function validateRequiredFields(array $row, array $requiredFields, array $colMap): bool
    {
        foreach ($requiredFields as $field) {
            if (!isset($colMap[$field]) || !isset($row[$colMap[$field]])) {
                return false;
            }
            
            $value = trim((string)$row[$colMap[$field]]);
            if (empty($value)) {
                return false;
            }
        }
        
        return true;
    }
    
    /**
     * Limpia y sanitiza un valor de cadena de texto
     * 
     * Este método elimina espacios en blanco al inicio y final del valor,
     * convirtiéndolo a string si no lo es. Es útil para normalizar datos
     * de texto antes de almacenarlos en la base de datos.
     * 
     * @param mixed $value El valor a limpiar
     * @return string El valor limpio como cadena de texto
     */
    protected function cleanString($value): string
    {
        return trim((string)$value);
    }
    
    /**
     * Limpia y convierte un valor a número decimal (float)
     * 
     * Este método convierte el valor proporcionado a un número decimal,
     * manejando casos donde el valor puede contener caracteres no numéricos
     * o estar en formatos diferentes. Es útil para campos monetarios o
     * cantidades decimales.
     * 
     * @param mixed $value El valor a convertir
     * @return float El valor convertido a float
     */
    protected function cleanFloat($value): float
    {
        return (float)$value;
    }
    
    /**
     * Limpia y convierte un valor a número entero
     * 
     * Este método convierte el valor proporcionado a un número entero,
     * eliminando cualquier parte decimal y manejando conversiones seguras
     * de diferentes tipos de datos.
     * 
     * @param mixed $value El valor a convertir
     * @return int El valor convertido a entero
     */
    protected function cleanInt($value): int
    {
        return (int)$value;
    }
    
    /**
     * Convierte una fecha de Excel a una instancia de Carbon
     * 
     * Este método toma un valor de fecha en formato Excel (número serial)
     * y lo convierte a un objeto Carbon para facilitar el manejo de fechas
     * en el sistema. Maneja errores gracefully retornando la fecha actual
     * si la conversión falla.
     * 
     * @param mixed $excelDate El valor de fecha en formato Excel
     * @return Carbon La fecha convertida como objeto Carbon
     */
    protected function parseExcelDate($excelDate): Carbon
    {
        try {
            return Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($excelDate));
        } catch (\Exception $e) {
            return now();
        }
    }
    
    /**
     * Verifica si un valor es numérico
     * 
     * Este método determina si el valor proporcionado puede ser considerado
     * como un número válido, incluyendo enteros, decimales y notación científica.
     * Es útil para validar campos que deben contener valores numéricos.
     * 
     * @param mixed $value El valor a verificar
     * @return bool True si el valor es numérico, false en caso contrario
     */
    protected function isNumeric($value): bool
    {
        return is_numeric($value);
    }
}
