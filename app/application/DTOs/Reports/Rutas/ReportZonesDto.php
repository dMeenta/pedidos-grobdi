<?php

namespace App\Application\DTOs\Reports\Rutas;

use App\Application\DTOs\Reports\ReportBaseDto;

class ReportZonesDto extends ReportBaseDto
{
    public function __construct(
        private int $totalVisitas,
        private array $totalPerEstado,
        array $data,
        array $filters = []
    ) {
        parent::__construct($data, $filters);
    }
    protected function getReportData(): array
    {
        return [
            'general_stats' => [
                'total_visitas' => $this->totalVisitas,
                'total_per_estado' => $this->totalPerEstado,
            ],
        ];
    }
}
