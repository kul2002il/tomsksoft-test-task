<?php
namespace models;

interface SalaryCalculated
{
    /**
     * Calculation salary
     *
     * @return float
     */
    public function salaryCalc():float;
}

