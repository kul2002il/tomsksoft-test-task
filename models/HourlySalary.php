<?php
namespace models;

class HourlySalary implements SalaryCalc
{
    /**
     * {@inheritdoc}
     *
     * @see \models\SalaryCalc::calc()
     */
    public function salaryCalc():float
    {
        return 200;
    }
}