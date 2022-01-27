<?php

namespace models\kernel;

interface SalaryCalculable
{
    /**
     * Get code, that storage use.
     *
     * @return string
     */
    public function getCode(): string;

    /**
     * Calculation salary
     *
     * @return float
     */
    public function salaryCalc(): float;
}