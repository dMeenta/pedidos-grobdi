<?php

namespace App\Domain\Reports\Doctor;

interface DoctorReportRepositoryInterface
{
    public function getTopDoctor(int $year);
    public function getAmountSpentByDoctorGroupedByMonth(int $year, ?int $doctorId): array;
    public function getMostConsumedProductsInTheMonthByDoctor(int $year, int $month, ?int $doctorId, ?int $limit, ?bool $withPrices = false);
    public function getAmountSpentByDoctorGroupedByTipo(int $year, int $month, ?int $doctorId);
    public function getDoctorInfo(int $doctorId): array;
}
