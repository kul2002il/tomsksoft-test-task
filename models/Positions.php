<?php
namespace models;

use core\ActiveRecord;

class Positions extends ActiveRecord
{

    public $name;

    public $code;

    public static function tableName(): string
    {
        return 'positions';
    }

    public static function fielsdDB(): array
    {
        return array_merge(parent::fielsdDB(), [
            'name',
            'code'
        ]);
    }
}

