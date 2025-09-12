<?php

namespace App\DTOs\Reportes;

use App\Models\Pedidos;
use Illuminate\Support\Facades\DB;

/**
 * DTO específico para reportes de ventas
 *
 * Esta clase contiene toda la estructura de datos necesaria para los reportes de ventas.
 * Incluye datos de visitadoras, productos, provincias y estadísticas generales.
 *
 * Propiedades que debe contener:
 * - visitadoras: Datos por visitadora (nombres, ventas, visitas)
 * - productos: Datos por producto (nombres, ventas, unidades)
 * - provincias: Datos por provincia (nombres, ventas, porcentaje)
 * - general: Datos generales del reporte (tendencias, metas vs realizado)
 */
class VentasData extends ReporteData
{
    // Propiedades específicas para reportes de ventas
    public array $visitadoras;  // Datos agrupados por visitadora
    public array $productos;    // Datos agrupados por producto
    public array $provincias;   // Datos agrupados por provincia
    public array $general;      // Datos generales del reporte

    /**
     * Constructor que inicializa datos de ventas
     *
     * @param array $filtros Filtros aplicados al reporte
     */
    public function __construct(array $filtros = [])
    {
        // Llamar al constructor padre con datos básicos
        parent::__construct(
            'Reporte de Ventas',
            'ventas',
            $filtros,
            [], // datos se inicializan después
            []  // estadísticas se calculan después
        );

        // Inicializar propiedades específicas
        $this->visitadoras = $this->getDatosVisitadoras($filtros);
        $this->productos = $this->getDatosProductos($filtros);
        $this->provincias = $this->getDatosProvincias($filtros);
        $this->general = $this->getDatosGeneral($filtros);
    }

    /**
     * Obtiene datos agrupados por visitadora desde pedidos
     *
     * @param array $filtros
     * @return array Datos de visitadoras con ventas y visitas
     */
    private function getDatosVisitadoras(array $filtros = []): array
    {
        // Consulta real a la tabla pedidos con join a users
        $query = Pedidos::selectRaw('users.name as visitadora, SUM(pedidos.prize) as ventas, COUNT(pedidos.id) as visitas')
            ->join('users', 'pedidos.user_id', '=', 'users.id')
            ->groupBy('users.id', 'users.name')
            ->orderByRaw('SUM(pedidos.prize) DESC');

        // Aplicar filtros si existen
        if (isset($filtros['anio_general'])) {
            $query->whereYear('pedidos.created_at', $filtros['anio_general']);
        }
        if (isset($filtros['mes_general'])) {
            $query->whereMonth('pedidos.created_at', $filtros['mes_general']);
        }

        $resultados = $query->get();

        return [
            'labels' => $resultados->pluck('visitadora')->toArray(),
            'ventas' => $resultados->pluck('ventas')->map(function($venta) { return (float) $venta; })->toArray(),
            'visitas' => $resultados->pluck('visitas')->map(function($visita) { return (int) $visita; })->toArray()
        ];
    }

    /**
     * Obtiene datos agrupados por producto desde detail_pedidos
     *
     * @param array $filtros
     * @return array Datos de productos con ventas y unidades
     */
    private function getDatosProductos(array $filtros = []): array
    {
        // Consulta real a detail_pedidos con join a pedidos
        $query = DB::table('detail_pedidos')
            ->selectRaw('detail_pedidos.articulo as producto, SUM(detail_pedidos.sub_total) as ventas, SUM(detail_pedidos.cantidad) as unidades')
            ->join('pedidos', 'detail_pedidos.pedidos_id', '=', 'pedidos.id')
            ->groupBy('detail_pedidos.articulo')
            ->orderByRaw('SUM(detail_pedidos.sub_total) DESC')
            ->limit(10); // Top 10 productos

        // Aplicar filtros si existen
        if (isset($filtros['anio_general'])) {
            $query->whereYear('pedidos.created_at', $filtros['anio_general']);
        }
        if (isset($filtros['mes_general'])) {
            $query->whereMonth('pedidos.created_at', $filtros['mes_general']);
        }

        $resultados = $query->get();

        return [
            'labels' => $resultados->pluck('producto')->toArray(),
            'ventas' => $resultados->pluck('ventas')->map(function($venta) { return (float) $venta; })->toArray(),
            'unidades' => $resultados->pluck('unidades')->map(function($unidad) { return (int) $unidad; })->toArray()
        ];
    }

    /**
     * Obtiene datos agrupados por provincia desde pedidos
     *
     * @param array $filtros
     * @return array Datos de provincias con ventas y porcentajes
     */
    private function getDatosProvincias(array $filtros = []): array
    {
        // Consulta real a la tabla pedidos agrupada por district
        $query = Pedidos::selectRaw('district as provincia, SUM(prize) as ventas, COUNT(*) as pedidos')
            ->groupBy('district')
            ->orderByRaw('SUM(prize) DESC')
            ->limit(10); // Top 10 provincias/distritos

        // Aplicar filtros si existen
        if (isset($filtros['anio_general'])) {
            $query->whereYear('created_at', $filtros['anio_general']);
        }
        if (isset($filtros['mes_general'])) {
            $query->whereMonth('created_at', $filtros['mes_general']);
        }

        $resultados = $query->get();

        $totalVentas = $resultados->sum('ventas');
        $porcentajes = $resultados->map(function($item) use ($totalVentas) {
            return $totalVentas > 0 ? round(($item->ventas / $totalVentas) * 100, 1) : 0;
        })->toArray();

        return [
            'labels' => $resultados->pluck('provincia')->toArray(),
            'ventas' => $resultados->pluck('ventas')->map(function($venta) { return (float) $venta; })->toArray(),
            'porcentaje' => $porcentajes
        ];
    }

    /**
     * Obtiene datos generales del reporte desde pedidos
     *
     * @param array $filtros
     * @return array Datos de tendencias y estadísticas generales
     */
    private function getDatosGeneral(array $filtros = []): array
    {
        $anio = $filtros['anio_general'] ?? date('Y');
        $mes = $filtros['mes_general'] ?? null;

        if ($mes) {
            // Si hay mes específico, mostrar datos diarios del mes
            return $this->getDatosMesEspecifico($anio, $mes);
        } else {
            // Si solo hay año, mostrar datos mensuales del año
            return $this->getDatosAnioCompleto($anio);
        }
    }

    /**
     * Obtiene datos para un mes específico desde pedidos
     *
     * @param int $anio
     * @param int $mes
     * @return array
     */
    private function getDatosMesEspecifico(int $anio, int $mes): array
    {
        // Consulta a la tabla de pedidos de la base de datos 
        $ventasPorDia = Pedidos::selectRaw('DAY(created_at) as dia, SUM(prize) as ventas, COUNT(*) as visitas')
            ->whereYear('created_at', $anio)
            ->whereMonth('created_at', $mes)
            ->groupByRaw('DAY(created_at)')
            ->orderByRaw('DAY(created_at)')
            ->get()
            ->keyBy('dia');

        $dias = range(1, cal_days_in_month(CAL_GREGORIAN, $mes, $anio));
        $ventas = [];
        $visitas = [];

        foreach ($dias as $dia) {
            $data = $ventasPorDia->get($dia);
            $ventas[] = $data ? (float) $data->ventas : 0;
            $visitas[] = $data ? (int) $data->visitas : 0;
        }

        return [
            'tipo' => 'diario',
            'periodo' => "Mes $mes del $anio",
            'labels' => array_map(function($dia) { return str_pad($dia, 2, '0', STR_PAD_LEFT); }, $dias),
            'ventas' => $ventas,
            'visitas' => $visitas,
            'total_ventas' => array_sum($ventas),
            'total_visitas' => array_sum($visitas),
            'promedio_venta' => count($dias) > 0 ? round(array_sum($ventas) / count($dias), 2) : 0
        ];
    }

    /**
     * Obtiene datos para un año completo (gráfico de barras por mes) desde pedidos
     *
     * @param int $anio
     * @return array
     */
    private function getDatosAnioCompleto(int $anio): array
    {
        // Consulta real a la tabla pedidos
        $ventasPorMes = Pedidos::selectRaw('MONTH(created_at) as mes, SUM(prize) as ventas, COUNT(*) as visitas')
            ->whereYear('created_at', $anio)
            ->groupByRaw('MONTH(created_at)')
            ->orderByRaw('MONTH(created_at)')
            ->get()
            ->keyBy('mes');

        $meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
                 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
        $ventas = [];
        $visitas = [];

        for ($i = 1; $i <= 12; $i++) {
            $data = $ventasPorMes->get($i);
            $ventas[] = $data ? (float) $data->ventas : 0;
            $visitas[] = $data ? (int) $data->visitas : 0;
        }

        return [
            'tipo' => 'mensual',
            'periodo' => "Año $anio",
            'labels' => $meses,
            'ventas' => $ventas,
            'visitas' => $visitas,
            'total_ventas' => array_sum($ventas),
            'total_visitas' => array_sum($visitas),
            'promedio_venta' => count($meses) > 0 ? round(array_sum($ventas) / count($meses), 2) : 0
        ];
    }

    /**
     * Convierte el DTO a array incluyendo propiedades específicas
     *
     * @return array Array completo con todos los datos de ventas
     */
    public function toArray(): array
    {
        return array_merge(parent::toArray(), [
            'visitadoras' => $this->visitadoras,
            'productos' => $this->productos,
            'provincias' => $this->provincias,
            'general' => $this->general,
        ]);
    }
}