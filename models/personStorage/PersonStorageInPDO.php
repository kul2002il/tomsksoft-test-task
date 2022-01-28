<?php

namespace models\personStorage;

use models\kernel\Person;
use models\kernel\PersonsStorage;

class PersonStorageInPDO implements PersonsStorage
{

    public function find(string $condition): array
    {
        $table = new ViewPerson();
        return $table->findAssoc($condition);
    }

    public function findById(int $id): array
    {
        $table = new ViewPerson();
        return $table->findAssoc("id=$id")[0];
    }

    public function save(array $person): void
    {
        $table = new EditPerson();
        $positionStorage = new PositionsStorage();
        $salaryMethodsStorage = new SalaryMethodsStorage();
        $person['id_position'] = $positionStorage->findAssoc(
            "code='{$person['position_code']}'")[0]['id'];
        $person['id_salary_method'] = $salaryMethodsStorage->findAssoc(
            "code='{$person['salary_method_code']}'")[0]['id'];
        $table->save($person);
    }
}