<?php

namespace models;

class Manager extends Person
{
    public function getStaff(): array
    {
        if($this->getId())
        {
            $factoryPeple = new PositionsSelector();
            return $factoryPeple->factoryPeople("id_manager = {$this->getId()}");
        }
        return [];
    }
}
