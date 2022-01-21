<?php

namespace models;

class SalaryReport
{
    /**
     * Report all Person.
     *
     * @return array
     */

    public function report(): array
    {
        $peopleFactory = new PositionsSelector();
        $stuff = $peopleFactory->factoryPeople('id_manager IS NULL');
        return array_map(function (Reportable $person) {
            return $this->reportCommand($person);
        }, $stuff);
    }

    /**
     * Report command of $person.
     *
     * @param Reportable $person
     * @return array
     */
    public function reportCommand(Reportable $person): array
    {
        $out = [
            'id' => $person->getId(),
            'name' => $person->getName(),
            'salary' => $person->getSalary(),
            'employees' => array_map(function (Reportable $person) {
                return $this->reportCommand($person);
            }, $person->getStaff())
        ];
        return $out;
    }
}