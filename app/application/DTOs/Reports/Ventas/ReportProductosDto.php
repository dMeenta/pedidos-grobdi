<?php

namespace App\Application\DTOs\Reports\Ventas;

use App\Application\DTOs\Reports\ReportBaseDto;

class ReportProductosDto extends ReportBaseDto
{
    public function __construct(
        private int $totalGroupedProducts,
        private int $totalProducts,
        private float $totalAmount,
        private float $averagePedidosPerDay,
        array $data,
        array $filters = []
    ) {
        parent::__construct($data, $filters);
    }
    protected function getReportData(): array
    {
        return [
            'general_stats' => [
                'total_grouped_products' => $this->totalGroupedProducts,
                'total_products' => $this->totalProducts,
                'total_amount' => $this->totalAmount,
                'average_pedidos_per_day' => $this->averagePedidosPerDay,
            ],
        ];
    }
}
