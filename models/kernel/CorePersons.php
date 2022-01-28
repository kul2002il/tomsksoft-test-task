<?php

namespace models\kernel;

class CorePersons implements VendorDataForReport
{
    private array $personFactory;
    private array $salaryMethods;

    public function __construct(
        private PersonsStorage $personStorage
    ) {
    }

    public function regPersonFactory(PersonFactory $factory): void
    {
        $this->personFactory[$factory->getCode()] = $factory;
    }

    /**
     * @return array
     */
    public function getPersonFactories(): array
    {
        return $this->personFactory;
    }

    public function regSalaryMethod(SalaryCalculable $method): void
    {
        $this->salaryMethods[$method->getCode()] = $method;
    }

    /**
     * @return array
     */
    public function getSalaryMethods(): array
    {
        return $this->salaryMethods;
    }

    public function getSalaryMethodByCode(string $code)
    {
        return $this->salaryMethods[$code];
    }

    public function getRootReport(): array
    {
        return $this->find('id_manager IS NULL');
    }

    public function loadPersonFromArray(array $data)
    {
        $person = $this->personFactory[$data['position_code']]->create();
        $person->setCore($this);
        $person->loadFromArray($data);
        return $person;
    }

    public function find(string $condition = ''): array
    {
        $raw = $this->personStorage->find($condition);
        return array_map(function ($row) {
            return $this->loadPersonFromArray($row);
        }, $raw);
    }

    public function findById(int $id)
    {
        return $this->loadPersonFromArray($this->personStorage->findById($id));
    }

    public function savePerson(Person $person)
    {
        $this->personStorage->save($person->exportToArray());
    }
}