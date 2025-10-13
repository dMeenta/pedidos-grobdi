<?php

namespace App\Application\Services\PedidosComercial;

use App\Repositories\PedidosComercial\PedidosComercialRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class PedidosComercialService
{
    public function __construct(
        protected PedidosComercialRepository $repository
    ) {
    }

    public function getListado(array $filters, int $perPage = 25): LengthAwarePaginator
    {
        return $this->repository->paginate($filters, $perPage);
    }

    public function getListadoExport(array $filters): Collection
    {
        return $this->repository->get($filters);
    }

    public function sanitizeFilters(array $filters): array
    {
        return array_filter(
            array_map(static function ($value) {
                return is_string($value) ? trim($value) : $value;
            }, $filters),
            static function ($value) {
                return $value !== null && $value !== '';
            }
        );
    }
}
