<?php

namespace App\Exports\PedidosComercial;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PedidosComercialExport implements FromCollection, WithHeadings
{
    public function __construct(
        protected Collection $pedidos
    ) {
    }

    public function collection(): Collection
    {
        return $this->pedidos->flatMap(function ($pedido) {
            $baseRow = [
                'orderId' => $pedido->orderId,
                'cliente' => $pedido->customerName,
                'visitadora' => optional($pedido->visitadora)->name,
                'nombre' => $pedido->customerName,
                'doctor' => optional($pedido->doctor)->name ?? $pedido->doctorName,
                'tipo_medico' => optional($pedido->doctor)->tipo_medico,
            ];

            $detalles = $pedido->detailpedidos;

            if ($detalles->isEmpty()) {
                return [array_merge($baseRow, [
                    'nombre_producto' => null,
                    'precio' => null,
                    'cantidad' => null,
                    'total' => null,
                ])];
            }

            return $detalles->map(function ($detalle) use ($baseRow) {
                $total = $detalle->sub_total;

                if ($total === null) {
                    $total = ($detalle->unit_prize ?? 0) * ($detalle->cantidad ?? 0);
                }

                return array_merge($baseRow, [
                    'nombre_producto' => $detalle->articulo,
                    'precio' => $detalle->unit_prize,
                    'cantidad' => $detalle->cantidad,
                    'total' => $total,
                ]);
            })->all();
        })->values();
    }

    public function headings(): array
    {
        return [
            'orderId',
            'Cliente',
            'Visitadora',
            'Nombre',
            'Doctor',
            'Tipo médico',
            'Nombre producto',
            'Precio',
            'Cantidad',
            'Total',
        ];
    }
}
