<?php

namespace models\database;

abstract class EditRecord extends ViewRecord
{
    public function save($data): void
    {
        $fields = $this->fields();
        foreach (array_keys($data) as $key) {
            if (!in_array($key, $fields)) {
                unset($data[$key]);
            }
        }
        if ($data['id'] ?? null) {
            $this->update($data);
            return;
        }
        $this->insert($data);
    }

    private function insert(array $data)
    {
        $table = $this->tableName();
        $fields = $this->fields();
        $intoStatement = implode(', ', $fields);
        $valuesStatement = ':' . implode(', :', $fields);
        $STH = $this->connection->prepare(
            "INSERT INTO $table ($intoStatement) values ($valuesStatement)"
        );
        $STH->execute($data);
    }

    private function update($data)
    {
        $table = $this->tableName();
        $fields = $this->fields();
        $set = [];
        unset($fields[array_flip($fields)['id']]);
        foreach ($fields as $field) {
            $set[] = $field . '=:' . $field;
        }
        $set = implode(', ', $set);
        $STH = $this->connection->prepare(
            "UPDATE $table SET $set WHERE id = :id"
        );
        $STH->execute($data);
    }
}