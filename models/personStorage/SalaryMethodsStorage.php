<?php

namespace models\personStorage;

use models\database\EditRecord;

class SalaryMethodsStorage extends EditRecord
{
    public function tableName(): string
    {
        return 'salary_method';
    }

    public function fields(): array
    {
        return [
            'id',
            'code',
            'name'
        ];
    }
}