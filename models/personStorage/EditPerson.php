<?php

namespace models\personStorage;

class EditPerson extends \models\database\EditRecord
{

    public function tableName(): string
    {
        return 'persons';
    }

    public function fields(): array
    {
        return [
            'id',
            'name',
            'phone',
            'telegram',
            'id_manager',
            'id_position',
            'id_salary_method',
        ];
    }
}