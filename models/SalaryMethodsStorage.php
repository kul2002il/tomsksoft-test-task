<?php
namespace models;

use core\ActiveRecord;

class SalaryMethodsStorage extends ActiveRecord
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
    public static function tableName(): string
    {
        return "salary_method";
    }

    /**
     * {@inheritdoc}
     *
     * @return string
     */
    public static function fielsdDB(): array
    {
        return array_merge(parent::fielsdDB(), [
            'name',
            'code'
        ]);
    }

    /**
     * Factory method that provide SalaryCalc class of record.
     *
     * @return SalaryCalc
     */
    public function getMethod(): SalaryCalc
    {
        $className = '\\models\\' . $this->code;
        return new $className();
    }
}