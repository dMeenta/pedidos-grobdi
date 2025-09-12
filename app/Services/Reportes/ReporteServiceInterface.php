<?php

namespace App\Services\Reportes;

/**
 * Interfaz para todos los servicios de reportes
 *
 * Esta interfaz define el contrato que deben cumplir todos los servicios de reportes.
 * Garantiza que todos los servicios tengan los mismos métodos básicos.
 */
interface ReporteServiceInterface
{
    /**
     * Obtiene los datos del reporte aplicando filtros
     *
     * @param array $filtros Filtros a aplicar al reporte
     * @return ReporteData Datos estructurados del reporte
     */
    // public function getData(array $filtros = []): ReporteData;

    /**
     * Obtiene la configuración de filtros disponibles
     *
     * @return array Configuración de filtros permitidos
     */
    // public function getFiltrosDisponibles(): array;

    /**
     * Valida que los filtros proporcionados sean correctos
     *
     * @param array $filtros Filtros a validar
     * @return bool True si son válidos, false si no
     */
    // public function validarFiltros(array $filtros): bool;

    /**
     * Aplica filtros adicionales a los datos del reporte
     *
     * @param ReporteData $data Datos del reporte
     * @param array $filtros Filtros a aplicar
     * @return ReporteData Datos filtrados
     */
    // public function aplicarFiltros(ReporteData $data, array $filtros): ReporteData;
}