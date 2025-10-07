<?php

namespace App\Application\Services\Reports\RutasReport;

use App\Application\DTOs\Reports\Rutas\ReportZonesDto;
use App\Application\Services\Reports\ReportBaseService;
use App\Infrastructure\Repository\ReportsRepository;
use App\Models\EstadoVisita;

class RutasReportService extends ReportBaseService
{
    protected string $cachePrefix = 'rutas_report_';

    public function __construct(protected ReportsRepository $repo)
    {
    }

    public function createInitialReport(): mixed
    {
        return [
            'zonesReport' => $this->getZonesReport()->toArray(),
        ];
    }

    public function getZonesReport(array $filters = []): ReportZonesDto
    {
        if (empty($filters)) {
            $filters = [
                'month' => now()->month,
                'year' => now()->year,
                'distritos' => []
            ];
        }

        $distritos = $filters['distritos'];
        if (is_string($distritos)) {
            $distritos = trim($distritos) === '[]' || trim($distritos) === '' ?
                [] : explode(',', trim($distritos, '[]'));
        }
        $filters['distritos'] = array_filter(array_map('intval', $distritos));

        $dataRaw = $this->repo->getRutasZonesReport($filters);
        $collection = collect($dataRaw);

        $estadosVisitas = EstadoVisita::pluck('id')->toArray();
        $estadosVisitasKeys = array_fill_keys($estadosVisitas, 0);

        $data = $collection->groupBy('distrito_id')
            ->map(function ($rows) use ($estadosVisitasKeys) {
                $estados = collect($rows)->pluck('total', 'estado_visita_id')->toArray();
                $allEstados = array_replace($estadosVisitasKeys, $estados);
                return [
                    'distrito_id' => $rows->first()['distrito_id'],
                    'distrito' => $rows->first()['distrito_name'],
                    'estados' => $allEstados,
                    'total_visitas' => collect($rows)->sum('total'),
                ];
            })->values()->toArray();

        $totalPerEstado = $collection->groupBy('estado_visita_id')->map->sum('total')->toArray();
        $totalPerEstado = array_replace($estadosVisitasKeys, $totalPerEstado);
        $totalVisitas = array_sum($totalPerEstado);

        return new ReportZonesDto(
            $totalVisitas,
            $totalPerEstado,
            $data,
            $filters
        );
    }
}
