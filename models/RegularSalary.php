<?php
namespace models;

class RegularSalary implements SalaryCalc
{

    /**
     * (non-PHPdoc)
     *
     * @see \models\SalaryCalc::calc()
     */
    public function salaryCalc():float
    {
        return 40000;
    }
}

