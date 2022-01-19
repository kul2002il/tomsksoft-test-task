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
        $stuff = Person::find('id_manager IS NULL');
        return array_map(function (Person $person) {
            return $this->reportCommand($person);
        }, $stuff);
    }

    /**
     * Report command of $person.
     *
     * @param Person $person
     * @return array
     */
    public function reportCommand(Person $person): array
    {
        $out = [
            'id' => $person->getId(),
            'name' => $person->name,
            'salary' => $person->salaryCalc(),
            'employees' => array_map(function (Person $person) {
                return $this->reportCommand($person);
            }, $person->employees())
        ];
        return $out;
    }
}