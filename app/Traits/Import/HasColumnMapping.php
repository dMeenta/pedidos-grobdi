<?php

namespace App\Traits\Import;

trait HasColumnMapping
{
    /**
     * Detecta el formato de columnas desde las filas de Excel
     * 
     * Este método analiza las filas de datos de Excel para determinar automáticamente
     * el mapeo de columnas basado en el contenido y estructura de los datos.
     * Es útil para manejar diferentes formatos de archivos Excel que pueden tener
     * columnas en posiciones diferentes.
     * 
     * @param array $rows Array de filas del archivo Excel a analizar
     * @return array Mapeo de columnas detectado con índices y nombres de campos
     */
    protected function detectColumns(array $rows): array
    {
        // Default column mapping - override in child classes
        return $this->getDefaultColumnMapping();
    }
    
    /**
     * Obtiene el mapeo de columnas por defecto
     * 
     * Este método abstracto debe ser implementado por las clases hijas para proporcionar
     * un mapeo de columnas estándar cuando no se puede detectar automáticamente el formato.
     * Define la estructura esperada de las columnas en el archivo de importación.
     * 
     * @return array Mapeo por defecto de columnas con índices y nombres de campos
     */
    abstract protected function getDefaultColumnMapping(): array;
    
    /**
     * Verifica si una fila debe ser omitida durante la importación
     * 
     * Este método determina si una fila del archivo Excel debe ser saltada durante
     * el proceso de importación. Las filas vacías o que contienen encabezados
     * generalmente deben ser omitidas para evitar errores en el procesamiento.
     * 
     * @param array $row La fila a evaluar
     * @param array $colMap El mapeo de columnas actual
     * @return bool True si la fila debe ser omitida, false en caso contrario
     */
    protected function shouldSkipRow(array $row, array $colMap): bool
    {
        // Skip completely empty lines
        $nonEmptyValues = array_filter($row, fn($v) => $v !== null && trim((string)$v) !== '');
        if (empty($nonEmptyValues)) {
            return true;
        }
        
        return $this->isHeaderRow($row, $colMap);
    }
    
    /**
     * Verifica si una fila es un encabezado
     * 
     * Este método identifica si una fila contiene encabezados de columna en lugar
     * de datos reales. Compara el contenido de la fila con palabras clave comunes
     * utilizadas en encabezados como "número", "artículo", "pedido", etc.
     * 
     * @param array $row La fila a evaluar
     * @param array $colMap El mapeo de columnas actual
     * @return bool True si la fila es un encabezado, false en caso contrario
     */
    protected function isHeaderRow(array $row, array $colMap): bool
    {
        $headerKeywords = $this->getHeaderKeywords();
        
        foreach ($colMap as $key => $colIndex) {
            if (isset($row[$colIndex])) {
                $value = strtolower(trim((string)$row[$colIndex]));
                if (in_array($value, $headerKeywords)) {
                    return true;
                }
            }
        }
        
        return false;
    }
    
    /**
     * Obtiene las palabras clave de encabezado
     * 
     * Este método devuelve un array con las palabras clave que se utilizan para
     * identificar filas de encabezado en los archivos de importación. Estas palabras
     * incluyen términos comunes como "número", "artículo", "pedido", etc.
     * 
     * @return array Array de palabras clave para identificar encabezados
     */
    protected function getHeaderKeywords(): array
    {
        return ['numero', 'número', 'pedido', 'order', 'nro', 'articulo', 'artículo', 'producto', 'item'];
    }
}
