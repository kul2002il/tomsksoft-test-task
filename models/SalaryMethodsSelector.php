<?php

namespace models;

class SalaryMethodsSelector extends ClassSelector
{

    /**
     * @inheritDoc
     */
    protected function code2classDictionary(): array
    {
        return [
            'Hourly' => HourlySalary::class,
            'Regular' => RegularSalary::class
        ];
    }

    /**
     * @inheritDoc
     */
    public function recordDeclare(): SelectorRecord
    {
        return new SalaryMethods();
    }
}