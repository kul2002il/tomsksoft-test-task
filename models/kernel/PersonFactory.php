<?php

namespace models\kernel;

interface PersonFactory
{
    public function getCode(): string;

    public function create(): Person;
}