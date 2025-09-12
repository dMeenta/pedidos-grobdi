<?php

namespace App\Services\Reportes;

use App\DTOs\Reportes\DoctoresData;
use App\DTOs\Reportes\ReporteData;

/**
 * Servicio específico para reportes de doctores
 *
 * Este servicio maneja toda la lógica de negocio relacionada con reportes de doctores:
 * - Creación del DTO de doctores
 * - Definición de filtros válidos para doctores
 * - Aplicación de filtros específicos (por año, tipo de doctor, doctor específico)
 * - Validación de datos
 *
 * Extiende BaseReporteService para heredar funcionalidad común como caching.
 */
class DoctoresReporteService extends BaseReporteService
{
    // Prefijo específico para cache de doctores
    protected string $cachePrefix = 'doctores_reporte_';

    /**
     * Crea el DTO específico para datos de doctores
     *
     * @param array $filtros Filtros aplicados
     * @return ReporteData DTO con datos de doctores
     */
    // protected function createReporteData(array $filtros = []): ReporteData

    /**
     * Define los filtros válidos para reportes de doctores
     *
     * @return array Configuración de filtros permitidos
     */
    // protected function getFiltrosValidos(): array

    /**
     * Aplica filtros específicos para reportes de doctores
     *
     * @param ReporteData $data Datos del reporte
     * @param array $filtros Filtros a aplicar
     * @return ReporteData Datos filtrados
     */
    // public function aplicarFiltros(ReporteData $data, array $filtros): ReporteData

    /**
     * Aplica filtro por año específico
     */
    // private function filtrarPorAnio(DoctoresData $data, int $anio): DoctoresData

    /**
     * Aplica filtro por tipo de doctor
     */
    // private function filtrarPorTipoDoctor(DoctoresData $data, string $tipo): DoctoresData

    /**
     * Aplica filtro por doctor específico
     */
    // private function filtrarPorDoctor(DoctoresData $data, int $doctorId): DoctoresData
}