<?php

namespace App\Domain\Interfaces;

use Illuminate\Support\Collection;

interface ReportsRepositoryInterface
{
    public function getVentasGeneralReport(int $month, int $year): Collection;
    public function getVentasVisitadorasReport(string $startDate, string $endDate): Collection;
    public function getVentasProductosReport(string $startDate, string $endDate): Collection;
    public function getRutasZonesReport(int $month, int $year, array $distritos): Collection;
    public function getAmountSpentAnuallyByDoctor(int $year, int $doctorId): array;
    public function getMostConsumedProductsMonthlyByDoctor(int $year, int $month, int $doctorId): Collection;
    public function getAmountSpentMonthlyGroupedByTipo(int $year, int $month, int $doctorId): Collection;
    public function getTopDoctorByAmountInfo(int $year): mixed;
    public function getDoctorInfo(int $doctorId): mixed;
    public function getRawDataGeoVentas(string $startDate, string $endDate): Collection;
    public function getRawDataGeoVentasDetails(string $startDate, string $endDate): Collection;
    public function getDepartamentosForMap(): array;
    public function getProvinciasForMap(): array;
    public function getProvinciasWithDepartamentoForMap(): array;
    public function getDistritosWithProvinciaAndDepartamentoForMap(): array;
    public function getDistritosWithProvinciaForMap(): array;
}
