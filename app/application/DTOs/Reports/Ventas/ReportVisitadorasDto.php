<?php

namespace App\Application\DTOs\Reports\Ventas;

use App\Application\DTOs\Reports\ReportBaseDto;

class ReportVisitadorasDto extends ReportBaseDto
{
    public function __construct(
        private float $totalAmount,
        private int $totalPedidos,
        private string $topVisitadora,
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
                'top_visitadora' => $this->topVisitadora
            ],
        ];
    }
}
