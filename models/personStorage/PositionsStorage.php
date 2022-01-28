<?php

namespace models\personStorage;

use models\database\EditRecord;

class PositionsStorage extends EditRecord
{
    public function tableName(): string
    {
        return 'positions';
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