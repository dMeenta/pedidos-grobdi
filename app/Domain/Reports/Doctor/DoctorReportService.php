<?php

namespace App\Domain\Reports\Doctor;

use App\Domain\Reports\Doctor\DoctorReportRepositoryInterface;

class DoctorReportService
{
    public function __construct(protected DoctorReportRepositoryInterface $repo) {}

    public function getDoctorReport(int $year, int $month, ?int $doctorId = null): array
    {
        $doctorName = 'No disponible';
        $tipoMedico = 'No disponible';

        if (!$doctorId) {
            [$doctorId, $doctorName, $tipoMedico] = $this->repo->getTopDoctor($year);
            if (!$doctorId) {
                $doctorId = null;
            }
        } else {
            $doctorInfo = $this->repo->getDoctorInfo($doctorId);
            $doctorName = $doctorInfo['name'];
            $tipoMedico = $doctorInfo['tipo_medico'];
        }

        return [
            'doctor' => $doctorName,
            'tipoMedico' => $tipoMedico,
            'amountSpentByDoctorGroupedByMonth' => $this->repo->getAmountSpentByDoctorGroupedByMonth($year, $doctorId),
            'topMostConsumedProductsInTheMonthByDoctor' => $this->repo->getMostConsumedProductsInTheMonthByDoctor($year, $month, $doctorId, 3),
            'amountSpentByDoctorGroupedByTipo' => $this->repo->getAmountSpentByDoctorGroupedByTipo($year, $month, $doctorId),
            'consumedProductsInTheMonthByDoctor' => $this->repo->getMostConsumedProductsInTheMonthByDoctor($year, $month, $doctorId, null, true)
        ];
    }

    public function getAmountsByDoctor(int $year, ?int $doctorId): array
    {
        return $this->repo->getAmountSpentByDoctorGroupedByMonth($year, $doctorId);
    }
}
