<?php

namespace models\database;

abstract class EditRecord extends ViewRecord
{
    public function save($data): void
    {
        $table = $this->tableName();
        $intoStatement = implode(', ', $this->fields());
        $valuesStatement = ':' . implode(', :', $this->fields());
        $STH = $this->connection->prepare(
            "INSERT INTO $table ($intoStatement) values ($valuesStatement)"
        );
        $STH->execute($data);
    }
}