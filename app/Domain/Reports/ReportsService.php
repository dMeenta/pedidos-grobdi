<?php

namespace App\Domain\Reports;

use App\Application\Services\Reports\RutasReport\RutasReportService;
use App\Application\Services\Reports\VentasReport\VentasReportService;
use App\Application\Services\Reports\DoctorsReport\DoctorsReportService;

class ReportsService
{
    public function __construct(
        protected RutasReportService $rutasReportService,
        protected VentasReportService $ventasReportService,
        protected DoctorsReportService $doctorsReportService,
    ) {
    }

    public function rutas()
    {
        return $this->rutasReportService;
    }
    public function ventas()
    {
        return $this->ventasReportService;
    }
    public function doctors()
    {
        return $this->doctorsReportService;
    }
}
