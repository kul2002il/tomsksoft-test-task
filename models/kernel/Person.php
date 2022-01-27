<?php

namespace models\kernel;

use models\kernel\SalaryCalculable;

class Person implements Reportable, PersonSavable
{
    protected $id;

    protected $name;

    protected $phone;

    protected $telegram;

    protected $id_manager;

    protected SalaryCalculable $salaryMethod;
    protected CorePersons $corePersons;

    public function setCore(CorePersons $corePersons)
    {
        $this->corePersons = $corePersons;
    }

    static public function loadFromPerson(self $person)
    {
        $new = new static();
        $new->id = $person->id;
        $new->name = $person->name;
        $new->phone = $person->phone;
        $new->telegram = $person->telegram;
        $new->salaryMethod = $person->salaryMethod;
        $new->id_manager = $person->id_manager;
        return $new;
    }

    public function setSalaryMethod(SalaryCalculable $sm): void
    {
        $this->salaryMethod = $sm;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSalary(): float
    {
        return $this->salaryMethod->salaryCalc();
    }

    public function getStaff(): array
    {
        return [];
    }

    public function loadFromArray(array $data)
    {
        $this->id = $data['id'];
        $this->name = $data['name'];
        $this->phone = $data['phone'];
        $this->telegram = $data['telegram'];
        $this->id_manager = $data['id_manager'];
        $this->salaryMethod = $this->corePersons->getSalaryMethodByCode(
            $data['salary_method_code']);
    }

    public function exportToArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'phone' => $this->phone,
            'telegram' => $this->telegram,
            'id_manager' => $this->id_manager,
            'salary_method_code' => $this->salaryMethod->getCode(),
        ];
    }
}


