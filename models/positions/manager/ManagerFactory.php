<?php

namespace models\positions\manager;

use models\kernel\Person;
use models\kernel\PersonFactory;

class ManagerFactory implements PersonFactory
{

    public function getCode(): string
    {
        return 'manager';
    }

    public function create(): Person
    {
        return new Manager();
    }
}