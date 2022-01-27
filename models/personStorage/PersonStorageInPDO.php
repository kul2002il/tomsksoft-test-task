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
        return $table->findAssoc("id=$id");
    }

    public function save(array $person): void
    {
        $table = new EditPerson();
        $table->save($person);
    }
}