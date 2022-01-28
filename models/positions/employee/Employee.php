<?php

namespace models\positions\employee;

use \models\kernel\Person;

class Employee extends Person
{
    public function __construct()
    {
        $this->myFactory = new EmployeeFactory();
    }
}