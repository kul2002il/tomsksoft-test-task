<?php

namespace models\salaryMethods;

use models\kernel\SalaryCalculable;

class RegularSalary implements SalaryCalculable
{

    /**
     * {@inheritdoc}
     */
    public function salaryCalc(): float
    {
        return 40000;
    }

    public function getCode(): string
    {
        return "Regular";
    }
}

