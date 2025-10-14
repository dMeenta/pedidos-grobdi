<?php

namespace App\Repositories\PedidosComercial;

use App\Models\Distrito;
use App\Models\Pedidos;
use Carbon\Carbon;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class PedidosComercialRepository
{
    public function paginate(array $filters = [], int $perPage = 25): LengthAwarePaginator
    {
        return $this->buildQuery($filters)->paginate($perPage);
    }

    public function get(array $filters = []): Collection
    {
        return $this->buildQuery($filters)->get();
    }

    protected function buildQuery(array $filters): Builder
    {
        $query = Pedidos::withInactive()->with([
            'visitadora',
            'user',
            'doctor.categoriadoctor',
            'doctor.especialidad',
            'doctor.centrosalud',
            'doctor.distrito',
            'zone',
            'detailpedidos',
        ]);

        $fechaInicio = $filters['fecha_inicio'] ?? null;
        $fechaFin = $filters['fecha_fin'] ?? null;

        if ($fechaInicio) {
            $query->whereDate('created_at', '>=', Carbon::parse($fechaInicio)->format('Y-m-d'));
        }

        if ($fechaFin) {
            $query->whereDate('created_at', '<=', Carbon::parse($fechaFin)->format('Y-m-d'));
        }

        if (!empty($filters['doctor'])) {
            $query->where('id_doctor', $filters['doctor']);
        }

        $distritoIdFilter = $filters['distrito'] ?? null;

        if ($distritoIdFilter) {
            $distritoId = (int) $distritoIdFilter;
            $distritoNombre = Distrito::find($distritoId)?->name;

            $query->where(function (Builder $builder) use ($distritoId, $distritoNombre) {
                $builder->whereHas('doctor', function (Builder $doctorQuery) use ($distritoId) {
                    $doctorQuery->where('distrito_id', $distritoId);
                });

                if ($distritoNombre) {
                    $builder->orWhere('district', 'like', '%'.$distritoNombre.'%');
                }
            });
        }

        if (!empty($filters['visitadora'])) {
            $query->whereHas('visitadora', function (Builder $visitadoraQuery) use ($filters) {
                $visitadoraQuery->where('name', 'like', '%'.$filters['visitadora'].'%');
            });
        }

        if (!empty($filters['cliente'])) {
            $query->where('customerName', 'like', '%'.$filters['cliente'].'%');
        }

        if (!empty($filters['order_id'])) {
            $query->where('orderId', 'like', '%'.$filters['order_id'].'%');
        }

        return $query->orderByDesc('created_at');
    }
}
