<?php

namespace App\Infrastructure\Repository;

use App\Domain\Interfaces\ReportsRepositoryInterface;
use App\Models\Departamento;
use App\Models\Distrito;
use App\Models\Doctor;
use App\Models\Pedidos;
use App\Models\Provincia;
use App\Models\VisitaDoctor;
use App\Traits\Query\ExcludeWordsFromQuery;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ReportsRepository implements ReportsRepositoryInterface
{
    use ExcludeWordsFromQuery;

    public function getVentasGeneralReport(int $month, int $year): Collection
    {
        $query = Pedidos::selectRaw("CASE
        WHEN ? > 0 THEN DAY(created_at)
        ELSE MONTH(created_at)
        END as period,
        SUM(prize) as total_amount,
        COUNT(*) as total_pedidos", [$month])->whereYear('created_at', $year)->groupBy('period')
            ->orderBy('period');

        if ($month > 0) {
            $query->whereMonth('created_at', $month);
        }

        return $query->get();
    }
    public function getVentasVisitadorasReport(string $startDate, string $endDate): array
    {
        $query = DB::table('pedidos as p')->join('users as u', 'u.id', '=', 'p.visitadora_id')
            ->select(
                'u.id as visitadora_id',
                'u.name as visitadora',
                DB::raw('SUM(p.prize) as total_amount'),
                DB::raw('COUNT(p.id) as total_pedidos')
            )->where('u.role_id', 6);

        if ($startDate && $endDate) {
            $query->whereBetween('p.created_at', [$startDate, $endDate]);
        }

        $results = $query->groupBy('u.id', 'u.name')->get();

        return $results->map(function ($item) {
            return [
                'visitadora' => $item->visitadora,
                'total_amount' => (float) $item->total_amount,
                'total_pedidos' => (int) $item->total_pedidos,
            ];
        })->toArray();
    }
    public function getVentasProductosReport(string $startDate, string $endDate): array
    {
        $query = DB::table('detail_pedidos as dp')
            ->selectRaw('dp.articulo as product, SUM(dp.sub_total) as total_amount, SUM(dp.cantidad) as total_products')
            ->join('pedidos as p', 'dp.pedidos_id', '=', 'p.id')
            ->whereNotNull('dp.articulo')
            ->where('dp.articulo', '!=', '')
            ->groupBy('dp.articulo')
            ->orderBy('total_amount', 'desc')
            ->limit(100)
            ->whereBetween('p.created_at', [$startDate, $endDate]);

        $query = $this->excludeArrayFromDataResults($query, 'dp.articulo', ['%delivery%', 'bolsa%']);


        return $query->get()->map(function ($item) {
            return [
                'product' => $item->product,
                'total_amount' => (float) $item->total_amount,
                'total_products' => (int) $item->total_products,
            ];
        })->toArray();
    }
    public function getVentasProvinciasReport(array $filters = []): array
    {
        return [];

    }
    public function getRutasZonesReport(array $filters = []): array
    {
        $month = $filters['month'];
        $year = $filters['year'];
        $distritos = $filters['distritos'] ?? [];

        $query = VisitaDoctor::query()
            ->select([
                'd.id as distrito_id',
                'd.name as distrito_name',
                'visita_doctor.estado_visita_id',
                DB::raw('COUNT(*) as total')
            ])
            ->join('doctor as dr', 'dr.id', '=', 'visita_doctor.doctor_id')
            ->join('distritos as d', 'd.id', '=', 'dr.distrito_id')
            ->whereMonth('fecha', $month)->whereYear('fecha', $year);

        if (!empty($distritos)) {
            $query->whereIn('dr.distrito_id', $distritos);
        }

        return $query->groupBy('d.id', 'd.name', 'visita_doctor.estado_visita_id')->get()->toArray();
    }

    public function getAmountSpentAnuallyByDoctor(int $year, int $doctorId): array
    {
        $rawData = Pedidos::selectRaw('MONTH(created_at) as month, SUM(prize) as total_amount')
            ->whereYear('created_at', $year)->where('id_doctor', $doctorId)
            ->groupBy('month')->pluck('total_amount', 'month')
            ->all();
        return array_replace(array_fill(1, 12, 0), $rawData);
    }

    public function getMostConsumedProductsMonthlyByDoctor(int $year, int $month, int $doctorId): Collection
    {
        $excludedWords = ['%delivery%', 'bolsa%'];
        $cols = ['dp.articulo', 'dp.cantidad', 'dp.sub_total'];

        $query = DB::table('detail_pedidos as dp')
            ->join('pedidos as p', 'dp.pedidos_id', '=', 'p.id')->select($cols)
            ->whereYear('p.created_at', $year)->whereMonth('p.created_at', $month)
            ->where('p.id_doctor', $doctorId);

        $this->excludeArrayFromDataResults($query, 'dp.articulo', $excludedWords);

        $rows = $query->get();

        $normalized = $rows->map(function ($r) {
            $articulo = strtoupper($r->articulo);
            $articulo = preg_replace('/\b\d+\s?(MG|MCG|G|ML|UI|UND)\b/u', '', $articulo);
            $articulo = preg_replace('/\bVIT\b/u', 'VITAMINA', $articulo);
            $articulo = preg_replace('/\bX\b/u', '', $articulo);
            $articulo = preg_replace('/[\/\-]+$/u', '', $articulo);
            $articulo = preg_replace('/[\/\-]+\s*$/u', '', $articulo);
            $articulo = preg_replace('/\s*[\/\-]+\s*/u', ' ', $articulo);
            $articulo = preg_replace('/\s+/', ' ', trim($articulo));

            $normalizedData = [
                'articulo' => $articulo,
                'cantidad' => $r->cantidad,
                'sub_total' => $r->sub_total
            ];

            return $normalizedData;
        });

        $grouped = $normalized->groupBy('articulo')->map(function ($items) {
            return [
                'articulo' => $items->first()['articulo'],
                'total_cantidad' => $items->sum('cantidad'),
                'total_sub_total' => $items->sum(fn($i) => $i['sub_total'] ?? 0)
            ];
        })->sortByDesc('total_cantidad')->take(100);

        return $grouped->values();
    }
    public function getAmountSpentMonthlyGroupedByTipo(int $year, int $month, int $doctorId): Collection
    {
        $excludedWords = ['%delivery%', 'bolsa%'];

        $query = DB::table('detail_pedidos as dp')
            ->join('pedidos as p', 'dp.pedidos_id', '=', 'p.id')
            ->selectRaw('
                UPPER(SUBSTRING_INDEX(dp.articulo, " ", 1)) as tipo,
                SUM(dp.sub_total) as total_sub_total
            ')
            ->whereYear('p.created_at', $year)
            ->whereMonth('p.created_at', $month)
            ->when($doctorId, fn($q) => $q->where('p.id_doctor', $doctorId))
            ->groupBy('tipo')
            ->orderByDesc('total_sub_total');

        $this->excludeArrayFromDataResults($query, 'dp.articulo', $excludedWords);

        return $query->get()
            ->map(function ($item) {
                return [
                    'tipo' => $item->tipo,
                    'total_sub_total' => (float) $item->total_sub_total
                ];
            });
    }
    public function getTopDoctorByAmountInfo(int $year): mixed
    {
        $topDoctor = Pedidos::selectRaw(
            'doctor.id as doctor_id,
            doctor.name,
            doctor.tipo_medico,
            SUM(pedidos.prize) as total_amount'
        )
            ->join('doctor', 'pedidos.id_doctor', '=', 'doctor.id')
            ->whereYear('pedidos.created_at', $year)
            ->groupBy('doctor.id', 'doctor.name', 'doctor.tipo_medico')
            ->orderByDesc('total_amount')
            ->first();

        return [
            'id' => $topDoctor->doctor_id,
            'name' => $topDoctor->name,
            'tipo_medico' => $topDoctor->tipo_medico,
            'is_top_doctor' => true,
        ];
    }
    public function getDoctorInfo(int $doctorId): mixed
    {
        $doctor = Doctor::select('id', 'name', 'tipo_medico')->where('id', $doctorId)->first();
        return [
            'id' => $doctor['id'],
            'name' => $doctor['name'],
            'tipo_medico' => $doctor['tipo_medico'],
            'is_top_doctor' => true,
        ];
    }

    // Repository
    public function getDoctoresByTipoAndYear(int $year): Collection
    {
        return DB::table('doctor as dr')
            ->leftJoin('pedidos as p', function ($join) use ($year) {
                $join->on('dr.id', '=', 'p.id_doctor')
                    ->whereYear('p.created_at', $year);
            })
            ->select(
                'dr.tipo_medico',
                DB::raw('COUNT(DISTINCT dr.id) as total_doctores'),
                DB::raw('COALESCE(SUM(p.prize), 0) as total_amount'),
                DB::raw('COUNT(p.id) as total_pedidos')
            )
            ->whereNotNull('dr.tipo_medico')
            ->groupBy('dr.tipo_medico')
            ->get();
    }

    public function getPedidosByTipoAndMonth(int $year): Collection
    {
        return DB::table('doctor as dr')
            ->join('pedidos as p', 'dr.id', '=', 'p.id_doctor')
            ->select(
                DB::raw('MONTH(p.created_at) as month'),
                DB::raw('dr.tipo_medico'),
                DB::raw('SUM(p.prize) as total_amount'),
                DB::raw('COUNT(p.id) as total_pedidos')
            )
            ->whereNotNull('dr.tipo_medico')
            ->whereYear('p.created_at', $year)
            ->groupBy('month', 'dr.tipo_medico')
            ->get();
    }

































































































    /* ---- Lo más profundo de este lugar... Provincias ---- */

    public function getRawDataGeoVentas(string $startDate, string $endDate): Collection
    {
        $query = Pedidos::query()
            ->selectRaw('district, SUM(prize) as total_amount, COUNT(*) as total_pedidos')
            ->whereNotNull('district')->where('district', '!=', '')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->where('zone_id', 1);
        $this->excludeArrayFromDataResults($query, 'district', ['%retiro en tienda%', '%recojo en tienda%']);

        return $query->groupBy('district')->get();
    }
    public function getRawDataGeoVentasDetails(string $startDate, string $endDate): Collection
    {
        $query = Pedidos::query()
            ->select([
                'pedidos.id',
                'pedidos.created_at',
                'pedidos.prize as total_amount',
                'pedidos.district',
                'users.name as created_by',
            ])
            ->leftJoin('users', 'pedidos.user_id', '=', 'users.id')
            ->whereNotNull('pedidos.district')->where('pedidos.district', '!=', '')
            ->where('pedidos.zone_id', 1)
            ->whereBetween('pedidos.created_at', [$startDate, $endDate]);
        $this->excludeArrayFromDataResults($query, 'pedidos.district', ['%retiro en tienda%', '%recojo en tienda%']);

        return $query->orderBy('pedidos.created_at', 'desc')->get();
    }

    public function getDepartamentosForMap(): array
    {
        return Departamento::select('id', 'name')->get()->toArray();
    }

    public function getProvinciasForMap(): array
    {
        return Provincia::select('id', 'name')->get()->toArray();
    }

    public function getProvinciasWithDepartamentoForMap(): array
    {
        return Provincia::select('id', 'name', 'departamento_id')
            ->with(['departamento:id,name'])
            ->get()
            ->toArray();
    }

    public function getDistritosWithProvinciaAndDepartamentoForMap(): array
    {
        return Distrito::select('id', 'name', 'provincia_id')
            ->with([
                'provincia:id,name,departamento_id',
                'provincia.departamento:id,name'
            ])
            ->get()
            ->toArray();
    }

    public function getDistritosWithProvinciaForMap(): array
    {
        return Distrito::select('id', 'name', 'provincia_id')
            ->with(['provincia:id,name'])
            ->get()
            ->toArray();
    }





}
