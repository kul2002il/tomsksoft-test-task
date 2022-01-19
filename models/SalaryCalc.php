<?php
namespace models;

interface SalaryCalc
{
    /**
     * Calculation salary
     *
     * @return float
     */
    public function salaryCalc():float;
}

