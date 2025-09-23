<?php

namespace App\Domain\Reports;

use App\Domain\Reports\Doctor\DoctorReportService;

class ReportsService
{
    protected DoctorReportService $doctorService;

    public function __construct(
        DoctorReportService $doctorService,
    ) {
        $this->doctorService = $doctorService;
    }

    public function doctor()
    {
        return $this->doctorService;
    }

    /* public function pedido()
    {
        return $this->pedidoService;
    }

    public function zona()
    {
        return $this->zonaService;
    } */
}
