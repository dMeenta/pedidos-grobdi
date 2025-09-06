<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class SimpleArrayImport implements ToCollection
{
    /**
     * Procesa una colección de filas de Excel y las retorna tal cual
     * 
     * Este método implementa la interfaz ToCollection de Laravel Excel y simplemente
     * retorna la colección de filas sin procesar. Es útil para casos donde se necesita
     * acceso directo a los datos crudos del archivo Excel sin transformaciones.
     * 
     * @param Collection $rows Colección de filas del archivo Excel
     * @return Collection La misma colección de filas sin modificaciones
     */
    public function collection(Collection $rows)
    {
        return $rows;
    }
}
