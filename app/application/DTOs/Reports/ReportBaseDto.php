<?php

namespace App\Application\DTOs\Reports;

/**
 * Parent class for Reports DTOs
 **/
abstract class ReportBaseDto
{
    public function __construct(
        public array $data = [],
        public array $filters = [],
    ) {
    }

    public function toArray(): array
    {
        return array_merge(
            $this->getReportData(),
            [
                'data' => $this->data,
                'filters' => $this->filters,
            ]
        );
    }
    abstract protected function getReportData(): array;
}
