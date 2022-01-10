<?php
namespace models;

use core\ActiveRecord;

/**
 *
 * @author ilia
 *        
 */
class SalaryMethodsStorage extends ActiveRecord
{

    public $name;

    public $code;

    public static function tableName(): string
    {
        return "salary_method";
    }

    public static function fielsdDB(): array
    {
        return array_merge(parent::fielsdDB(), [
            'name',
            'code'
        ]);
    }

    public function getMethod(): SalaryCalc
    {
        $className = '\\models\\' . $this->code;
        return new $className();
    }
}

