<?php

namespace App\Imports;

use App\Traits\Import\HasDataValidation;
use App\Traits\Import\HasImportResponse;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

abstract class BaseImport implements ToCollection
{
<<<<<<< HEAD
    use HasImportResponse, HasDataValidation;
=======
    use HasImportResponse;
>>>>>>> f76f4ac7a11c11334cc0a0e9b770a16c887d9683
    
    /**
    * Estadísticas del proceso de importación
     */
    protected array $stats = [
        'processed' => 0,
        'created' => 0,
        'updated' => 0,
        'skipped' => 0,
        'errors' => 0
    ];
    
    /**
     * Método collection requerido por la interfaz ToCollection
     * 
     * Este método es el punto de entrada principal para el procesamiento de archivos Excel.
     * Inicializa el proceso de importación, detecta el mapeo de columnas y procesa cada fila.
     * Finalmente, finaliza el proceso de importación.
     * 
     * @param Collection $rows Colección de filas del archivo Excel a procesar
     * @return void
     */
    public function collection(Collection $rows): void
    {
        $this->initializeImport();
        
        $rowsArray = $rows->toArray();
    $colMap = $this->detectColumns($rowsArray);
        
        foreach ($rowsArray as $index => $row) {
            $this->processRow($row, $index, $colMap);
        }
        
        $this->finalizeImport();
    }
    
    /**
     * Inicializa el proceso de importación
     * 
     * Este método se ejecuta al inicio del proceso de importación.
     * Por defecto, reinicia las estadísticas. Las clases hijas pueden
     * sobrescribir este método para agregar lógica de inicialización específica.
     * 
     * @return void
     */
    protected function initializeImport(): void
    {
        $this->resetStats();
    }
    
    /**
     * Procesa una fila individual
     * 
     * Este método abstracto debe ser implementado por las clases hijas
     * para definir la lógica específica de procesamiento de cada fila
     * del archivo Excel según el tipo de importación.
     * 
     * @param array $row La fila de datos a procesar
     * @param int $index El índice de la fila en el archivo
     * @param array $colMap El mapeo de columnas detectado
     * @return void
     */
    abstract protected function processRow(array $row, int $index, array $colMap): void;
    
    /**
     * Finaliza el proceso de importación
     * 
     * Este método se ejecuta al final del proceso de importación.
     * Por defecto, establece la respuesta final basada en las estadísticas.
     * Las clases hijas pueden sobrescribir este método para agregar lógica
     * de finalización específica.
     * 
     * @return void
     */
    protected function finalizeImport(): void
    {
        $this->setFinalResponse();
    }

    /**
     * Detecta el mapeo de columnas desde las filas del archivo
     * 
     * Este método analiza las filas del archivo Excel para determinar
     * automáticamente el mapeo de columnas. Por defecto, retorna el
     * mapeo de columnas por defecto, pero puede ser sobrescrito por
     * las clases hijas para implementar lógica de detección más sofisticada.
     * 
     * @param array $rows Array de filas del archivo Excel
     * @return array Mapeo de columnas detectado
     */
    protected function detectColumns(array $rows): array
    {
        // Default column mapping - override in child classes
        return $this->getDefaultColumnMapping();
    }

    /**
     * Obtiene el mapeo de columnas por defecto
     * 
     * Este método abstracto debe ser implementado por las clases hijas
     * para proporcionar el mapeo de columnas estándar que se utilizará
     * cuando no se pueda detectar automáticamente el formato del archivo.
     * 
     * @return array Mapeo de columnas por defecto
     */
    abstract protected function getDefaultColumnMapping(): array;

    /**
     * Determina si una fila debe ser omitida durante el procesamiento
     * 
     * Este método evalúa si una fila debe ser saltada durante el proceso
     * de importación. Las filas completamente vacías o que contienen
     * encabezados generalmente deben ser omitidas.
     * 
     * @param array $row La fila a evaluar
     * @param array $colMap El mapeo de columnas actual
     * @return bool True si la fila debe ser omitida, false en caso contrario
     */
    protected function shouldSkipRow(array $row, array $colMap): bool
    {
        // Skip completely empty rows
        $nonEmptyValues = array_filter($row, fn($v) => $v !== null && trim((string)$v) !== '');
        if (empty($nonEmptyValues)) {
            return true;
        }
        return $this->isHeaderRow($row, $colMap);
    }

    /**
     * Detecta heurísticamente si una fila es de encabezado
     * 
     * Este método utiliza palabras clave comunes para identificar filas
     * que contienen encabezados de columna en lugar de datos reales.
     * Compara el contenido de las columnas mapeadas con palabras clave
     * como "número", "artículo", "pedido", etc.
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
                if (in_array($value, $headerKeywords, true)) {
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * Obtiene las palabras clave para identificar encabezados
     * 
     * Este método retorna un array con las palabras clave que se utilizan
     * para identificar filas de encabezado en los archivos de importación.
     * 
     * @return array Array de palabras clave de encabezado
     */
    protected function getHeaderKeywords(): array
    {
        return ['numero', 'número', 'pedido', 'order', 'nro', 'articulo', 'artículo', 'producto', 'item'];
    }
    
    /**
     * Reinicia las estadísticas del proceso de importación
     * 
     * Este método reinicia todos los contadores de estadísticas a cero,
     * preparándolos para un nuevo proceso de importación.
     * 
     * @return void
     */
    protected function resetStats(): void
    {
        $this->stats = [
            'processed' => 0,
            'created' => 0, 
            'updated' => 0,
            'skipped' => 0,
            'errors' => 0
        ];
    }
    
    /**
     * Incrementa el contador de una estadística específica
     * 
     * Este método incrementa en uno el contador de la estadística especificada,
     * siempre y cuando la estadística exista en el array de estadísticas.
     * 
     * @param string $stat El nombre de la estadística a incrementar
     * @return void
     */
    protected function incrementStat(string $stat): void
    {
        if (isset($this->stats[$stat])) {
            $this->stats[$stat]++;
        }
    }
    
    /**
     * Establece la respuesta final basada en las estadísticas
     * 
     * Este método analiza las estadísticas del proceso de importación
     * y establece la respuesta final apropiada (éxito, advertencia o error)
     * basada en los resultados obtenidos.
     * 
     * @return void
     */
    protected function setFinalResponse(): void
    {
        $message = $this->buildStatsMessage();
        
        if ($this->stats['errors'] > 0) {
            $this->setErrorResponse($message);
        } elseif ($this->stats['created'] > 0 || $this->stats['updated'] > 0) {
            $this->setSuccessResponse($message);
        } else {
            $this->setWarningResponse($message);
        }
    }
    
    /**
     * Construye el mensaje de estadísticas del proceso
     * 
     * Este método crea un mensaje descriptivo con las estadísticas
     * del proceso de importación, incluyendo el número de filas
     * procesadas, creadas, actualizadas, omitidas y con errores.
     * 
     * @return string El mensaje de estadísticas formateado
     */
    protected function buildStatsMessage(): string
    {
        return sprintf(
            "Procesados: %d | Creados: %d | Actualizados: %d | Omitidos: %d | Errores: %d",
            $this->stats['processed'],
            $this->stats['created'],
            $this->stats['updated'],
            $this->stats['skipped'],
            $this->stats['errors']
        );
    }
}
