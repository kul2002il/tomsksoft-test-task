<?php

namespace models;

interface Reportable
{
    public function getId();

    public function getName(): string;

    public function getSalary(): float;

    /**
     * @return Reportable[]
     */
    public function getStaff(): array;
}