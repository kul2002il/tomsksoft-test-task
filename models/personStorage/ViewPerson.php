<?php

namespace models\personStorage;

use models\database\ViewRecord;

class ViewPerson extends ViewRecord
{

    public function tableName(): string
    {
        return 'persons_with_codes';
    }

    public function fields(): array
    {
        return [
            'id',
            'name',
            'phone',
            'telegram',
            'id_manager',
            'position_code',
            'salary_method_code',
        ];
    }
}