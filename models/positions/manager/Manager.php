<?php

namespace models\positions\manager;

use models\kernel\Person;

class Manager extends Person
{
    private array $staff = [];
    public function getStaff(): array
    {
        return $this->staff;
    }
    public function loadFromArray(array $data)
    {
        parent::loadFromArray($data);
        $id = $this->getId();
        $this->staff = $this->corePersons->find("id_manager = $id");
    }
}
