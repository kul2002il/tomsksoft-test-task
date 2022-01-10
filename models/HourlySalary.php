<?php
namespace models;

class HourlySalary implements SalaryCalc
{

    /**
     * (non-PHPdoc)
     *
     * @see \models\SalaryCalc::calc()
     */
    public function salaryCalc():float
    {
        return 200;
    }
}

