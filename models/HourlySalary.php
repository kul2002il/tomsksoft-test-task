<?php
namespace models;

class HourlySalary implements SalaryCalculated
{
    /**
     * {@inheritdoc}
     *
     * @see \models\SalaryCalculated::calc()
     */
    public function salaryCalc():float
    {
        return 200;
    }
}