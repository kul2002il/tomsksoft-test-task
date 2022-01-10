<?php
namespace models;

class SalaryReport
{

    public function report(): array
    {
        $stuff = Person::find('id_manager IS NULL');
        return array_map(function (PersonInterface $person) {
            return $this->reportCommand($person);
        }, $stuff);
    }

    public function reportCommand(PersonInterface $person): array
    {
        ManagerDecorator::tryBeFrom($person);
        $out = [
            'id' => $person->getId(),
            'name' => $person->name,
            'salary' => $person->salaryCalc()
        ];
        if ($person->amI(ManagerDecorator::class)) {
            $out += [
                'employees' => array_map(function (PersonInterface $person) {
                    return $this->reportCommand($person);
                }, $person->employees)
            ];
        }
        return $out;
    }
}

