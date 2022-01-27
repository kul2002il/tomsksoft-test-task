<?php

namespace models\salaryReport;

use models\kernel\VendorDataForReport;
use models\kernel\Reportable;

class SalaryReport implements ReportRenderable
{
    public function __construct(
        private VendorDataForReport $vendor
    ) {}

    public function report(): array
    {
        $stuff = $this->vendor->getRootReport();
        return array_map(function (Reportable $person) {
            return $this->reportCommand($person);
        }, $stuff);
    }

    /**
     * Report command of $person.
     *
     * @param Reportable $person
     * @return array
     */
    private function reportCommand(Reportable $person): array
    {
        $out = [
            'id' => $person->getId(),
            'name' => $person->getName(),
            'salary' => $person->getSalary(),
            'employees' => array_map(function (Reportable $person) {
                return $this->reportCommand($person);
            }, $person->getStaff())
        ];
        return $out;
    }
}