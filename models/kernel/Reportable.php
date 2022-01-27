<?php

namespace models\kernel;

interface Reportable
{
    public function getId(): ?int;

    public function getName(): string;

    public function getSalary(): float;

    /**
     * @return Reportable[]
     */
    public function getStaff(): array;
}