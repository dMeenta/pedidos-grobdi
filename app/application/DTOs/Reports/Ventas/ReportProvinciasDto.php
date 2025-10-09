<?php

namespace App\Application\DTOs\Reports\Ventas;

use App\Application\DTOs\Reports\ReportBaseDto;

class ReportProvinciasDto extends ReportBaseDto
{
    public function __construct(
        private float $totalAmount,
        private int $totalPedidos,
        array $data,
        array $filters = []
    ) {
        parent::__construct($data, $filters);
    }
    protected function getReportData(): array
    {
        return [
            'general_stats' => [
                'total_amount' => $this->totalAmount,
                'total_pedidos' => $this->totalPedidos,
            ],
        ];
    }
}
