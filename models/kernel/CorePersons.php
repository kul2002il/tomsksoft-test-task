<?php

namespace models\kernel;

class CorePersons implements VendorDataForReport
{
    private array $personFactory;
    private array $salaryMethods;

    public function __construct(
        private PersonsStorage $personStorage
    ) {}

    public function regPersonFactory(PersonFactory $factory): void
    {
        $this->personFactory[$factory->getCode()] = $factory;
    }

    public function regSalaryMethod(SalaryCalculable $method): void
    {
        $this->salaryMethods[$method->getCode()] = $method;
    }

    public function getRootReport(): array
    {
        return $this->find('id_manager IS NULL');
    }

    public function find(string $condition = ''): array
    {
        $raw = $this->personStorage->find($condition);
        return array_map(function($row){
            $person = $this->personFactory[$row['position_code']]->create();
            $person->setCore($this);
            $person->loadFromArray($row);
            return $person;
        }, $raw);
    }

    public function getSalaryMethodByCode(string $code)
    {
        return $this->salaryMethods[$code];
    }
}