<?php

namespace models;

class SalaryMethods extends SelectorRecord
{

    /**
     * @inheritDoc
     */
    public static function tableName(): string
    {
        return 'salary_method';
    }
}