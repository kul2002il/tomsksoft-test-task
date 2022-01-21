<?php

namespace models;

abstract class SelectorRecord extends \core\ActiveRecord
{
    /**
     * Human-language name of methods.
     * @var string
     */
    public string $name;

    /**
     * Name of class-realization SalaryCalc Interface that use for calculation.
     * @var string
     */
    public $code;

    /**
     * {@inheritdoc}
     *
     * @return string
     */
    public static function fieldsDB(): array
    {
        return array_merge(parent::fieldsDB(), [
            'name',
            'code'
        ]);
    }
}