<?php

namespace models\kernel;

interface PersonSavable
{
    public function loadFromArray(array $data);

    public function exportToArray(): array;
}