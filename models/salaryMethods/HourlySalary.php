<?php

namespace models\salaryMethods;

use models\kernel\SalaryCalculable;

class HourlySalary implements SalaryCalculable
{
    /**
     * {@inheritdoc}
     */
    public function salaryCalc(): float
    {
        return 200;
    }

    public function getCode(): string
    {
        return "Hourly";
    }
}