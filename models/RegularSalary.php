<?php
namespace models;

class RegularSalary implements SalaryCalculated
{

    /**
     * {@inheritdoc}
     *
     * @see \models\SalaryCalculated::calc()
     */
    public function salaryCalc():float
    {
        return 40000;
    }
}

