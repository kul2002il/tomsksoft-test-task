<?php

namespace models;

class Positions extends SelectorRecord
{

    /**
     * @inheritDoc
     */
    public static function tableName(): string
    {
        return 'positions';
    }
}