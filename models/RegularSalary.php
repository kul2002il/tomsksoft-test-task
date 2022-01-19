<?php
namespace models;

class RegularSalary implements SalaryCalc
{

    /**
     * {@inheritdoc}
     *
     * @see \models\SalaryCalc::calc()
     */
    public function salaryCalc():float
    {
        return 40000;
    }
}

