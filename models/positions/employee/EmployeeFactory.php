<?php

namespace models\positions\employee;

use models\kernel\Person;
use models\kernel\PersonFactory;

class EmployeeFactory implements PersonFactory
{

    public function getCode(): string
    {
        return 'employee';
    }

    public function create(): Person
    {
        return new Employee();
    }
}