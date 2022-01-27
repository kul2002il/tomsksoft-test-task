<?php

namespace models\kernel;

interface PersonsStorage
{
    public function find(string $condition): array;

    public function findById(int $id): array;

    public function save(array $person): void;
}