<?php

namespace App\Services\Reportes;

use App\DTOs\Reportes\ReporteData;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Collection;

/**
 * Clase base para todos los servicios de reportes
 *
 * Esta clase proporciona funcionalidad común a todos los servicios de reportes:
 * - Caching automático
 * - Validación de filtros
 * - Gestión de configuración
 * - Helpers para fechas y meses
 *
 * Los servicios específicos deben extender esta clase e implementar
 * los métodos abstractos.
 */
abstract class BaseReporteService implements ReporteServiceInterface
{
    // Configuración de cache
    protected string $cachePrefix = 'reporte_';  // Prefijo para keys de cache
    protected int $cacheTtl = 3600;              // TTL en segundos (1 hora)

    /**
     * Método abstracto que debe implementar cada servicio específico
     * para crear el DTO correspondiente
     */
    // abstract protected function createReporteData(array $filtros = []): ReporteData;

    /**
     * Método abstracto que define los filtros válidos para cada reporte
     */
    // abstract protected function getFiltrosValidos(): array;

    /**
     * Obtiene los datos del reporte con caching automático
     */
    // public function getData(array $filtros = []): ReporteData

    /**
     * Obtiene configuración de filtros disponibles
     */
    // public function getFiltrosDisponibles(): array

    /**
     * Valida filtros proporcionados contra configuración
     */
    // public function validarFiltros(array $filtros): bool

    /**
     * Aplica filtros adicionales (método que pueden sobrescribir las subclases)
     */
    // public function aplicarFiltros(ReporteData $data, array $filtros): ReporteData

    /**
     * Genera una key única para cache basada en filtros
     */
    // protected function generateCacheKey(array $filtros): string

    /**
     * Limpia el cache para este tipo de reporte
     */
    // protected function clearCache(): void

    /**
     * Helper para obtener array de meses en español
     */
    // protected function getMeses(): array

    /**
     * Helper para obtener años disponibles (últimos 5 años)
     */
    // protected function getAniosDisponibles(): array
}