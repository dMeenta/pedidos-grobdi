<?php

namespace App\Application\Services\Pedidos;

use App\Models\DetailPedidos;
use App\Traits\Query\ExcludeWordsFromQuery;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PedidosService
{
    use ExcludeWordsFromQuery;

    public function getPedidosDetailsByTipoMedico(
        string $tipoMedico,
        ?int $month = null,
        ?int $year = null,
        ?string $startDate = null,
        ?string $endDate = null
    ) {
        $query = DetailPedidos::query()
            ->where('detail_pedidos.status', true)
            ->join('pedidos as p', 'detail_pedidos.pedidos_id', '=', 'p.id')
            ->join('doctor as dr', 'p.id_doctor', '=', 'dr.id')
            ->where('p.status', true)
            ->where('dr.tipo_medico', $tipoMedico);

        $excludedWords = ['%delivery%', 'bolsa%'];
        $this->excludeArrayFromDataResults($query, 'detail_pedidos.articulo', $excludedWords);

        $this->applyDateFilter($query, 'p.created_at', $startDate, $endDate, $month, $year);

        return $query->select([
            'dr.id',
            'dr.name',
            'dr.first_lastname',
            'dr.second_lastname',
            DB::raw('SUM(detail_pedidos.sub_total) as total_sub_total')
        ])
            ->groupBy('dr.id', 'dr.name', 'dr.first_lastname', 'dr.second_lastname')
            ->get()
            ->map(function ($item) {
                $parts = array_filter([
                    $item->name ?? '',
                    $item->first_lastname ?? '',
                    $item->second_lastname ?? ''
                ], fn($part) => !empty(trim($part)));

                return (object) [
                    'id' => $item->id,
                    'name' => implode(' ', $parts),
                    'total_sub_total' => (float) $item->total_sub_total,
                    'monto_sin_igv' => $item->total_sub_total * 0.82
                ];
            });
    }

    private function applyDateFilter($query, string $column, ?string $startDate, ?string $endDate, ?int $month, ?int $year)
    {
        if ($startDate !== null && $endDate !== null) {
            $start = Carbon::parse($startDate)->startOfDay();
            $end = Carbon::parse($endDate)->endOfDay();
            $query->whereBetween($column, [$start, $end]);
        } else {
            $query->whereMonth($column, $month ?? now()->month)
                ->whereYear($column, $year ?? now()->year);
        }
    }

    public function calculateTotalSubTotal(callable $filterCallBack)
    {
        $query = DetailPedidos::query()
            ->where('detail_pedidos.status', true)
            ->join('pedidos', 'detail_pedidos.pedidos_id', '=', 'pedidos.id');

        $excludedWords = ['%delivery%', 'bolsa%'];
        $this->excludeArrayFromDataResults($query, 'detail_pedidos.articulo', $excludedWords);

        $filterCallBack($query);

        return (float) $query->sum('detail_pedidos.sub_total');

    }

}
