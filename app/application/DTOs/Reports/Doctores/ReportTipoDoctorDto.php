<?php

namespace App\Application\DTOs\Reports\Doctores;

use App\Application\DTOs\Reports\ReportBaseDto;

class ReportTipoDoctorDto extends ReportBaseDto
{
    public function __construct(
        private int $totalDoctores,
        private float $totalAmount,
        private int $totalPedidos,
        private string $topTipoByAmount,
        private string $topTipoByPedidos,
        private array $tiposResume,
        array $data,
        array $filters = []
    ) {
        parent::__construct($data, $filters);
    }
    protected function getReportData(): array
    {
        return [
            'resume' => [
                'total_doctores' => $this->totalDoctores,
                'total_amount' => $this->totalAmount,
                'top_tipo_by_amount' => $this->topTipoByAmount,
                'total_pedidos' => $this->totalPedidos,
                'top_tipo_by_pedidos' => $this->topTipoByPedidos,
                'tipos_resume' => $this->tiposResume
            ]
        ];
    }
}
