<?php

namespace App\Application\Services\Reports\RutasReport;

use App\Application\DTOs\Reports\Rutas\ReportZonesDto;
use App\Application\Services\Reports\ReportBaseService;
use App\Infrastructure\Repository\ReportsRepository;
use App\Models\EstadoVisita;
use App\Models\Muestras;
use App\Models\TipoMuestra;
use Carbon\Carbon;
use Illuminate\Support\Collection;

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
        $month = $filters['month'] ?? now()->month;
        $year = $filters['year'] ?? now()->year;
        $distritos = $filters['distritos'] ?? [];

        $dataRaw = $this->repo->getRutasZonesReport($month, $year, $distritos);

        $estadosVisitasKeys = array_fill_keys(EstadoVisita::pluck('id')->toArray(), 0);

        $data = $dataRaw->groupBy('distrito_id')
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

        $totalPerEstado = $dataRaw->groupBy('estado_visita_id')->map->sum('total')->toArray();
        $totalPerEstado = array_replace($estadosVisitasKeys, $totalPerEstado);
        $totalVisitas = array_sum($totalPerEstado);

        return new ReportZonesDto(
            $totalVisitas,
            $totalPerEstado,
            $data,
            compact('month', 'year', 'distritos')
        );
    }

    public function getMuestrasReport(array $filters = []): array
    {
        $start_date = Carbon::parse($filters['start_date'] ?? now()->startOfMonth())->startOfDay();
        $end_date = Carbon::parse($filters['end_date'] ?? now())->endOfDay();

        $rawData = $this->repo->getRawMuestrasData($start_date, $end_date);

        $dataFrascoOriginal = $rawData->where('tipo_frasco', 'Frasco Original')->values();
        $dataFrascoMuestra = $rawData->where('tipo_frasco', 'Frasco Muestra')->values();

        return [
            'general_stats' => [
                'total_muestras' => count($rawData),
                'total_quantity' => $this->getMuestrasQuantity($rawData),
                'total_amount' => $this->getMuestrasTotalAmount($rawData),
                'by_tipo_frasco' => $this->groupByTipoFrasco($rawData),
                'by_tipo_muestra' => $this->groupByTipoMuestra($rawData)
            ],
            'data' => [
                'frasco_original' => $dataFrascoOriginal,
                'frasco_muestra' => $dataFrascoMuestra,
            ],
            'filters' => compact('start_date', 'end_date')
        ];
    }

    private function groupByTipoFrasco(Collection $muestras): array
    {
        return collect(Muestras::TIPOS_FRASCO)->mapWithKeys(function (string $tipoFrasco) use ($muestras) {
            $group = $muestras->where('tipo_frasco', $tipoFrasco);

            return [
                $tipoFrasco => $this->getPartialGeneralStats($group)
            ];
        })->all();
    }

    private function groupByTipoMuestra(Collection $muestras): array
    {
        $allTipos = TipoMuestra::all()->keyBy('id');

        $muestrasPorTipo = $muestras
            ->filter(fn($m) => $m->tipoMuestra)
            ->groupBy(fn($m) => $m->tipoMuestra->id);

        return $allTipos->mapWithKeys(function (TipoMuestra $tipo) use ($muestrasPorTipo) {
            $group = $muestrasPorTipo->get($tipo->id, collect());

            return [
                $tipo->name => $this->getPartialGeneralStats($group)
            ];
        })->all();
    }

    private function getPartialGeneralStats(Collection $collection): array
    {
        return [
            'count' => count($collection),
            'quantity' => $this->getMuestrasQuantity($collection),
            'amount' => $this->getMuestrasTotalAmount($collection)
        ];
    }

    private function getMuestrasQuantity(Collection $collection): int
    {
        return $collection->sum('cantidad_de_muestra');
    }
    private function getMuestrasTotalAmount(Collection $collection): float
    {
        return $collection->sum(fn($m) => ($m->precio ?? 0) * $m->cantidad_de_muestra);
    }
}
