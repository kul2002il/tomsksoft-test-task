<?php

/**
 * ActiveRecord is CRUD class for heirs.
 * It use global $mysqli connection.
 */

namespace core;

abstract class ActiveRecord
{

    private $id;

    /**
     * Name table of DB for class.
     *
     * @return string
     */
    public static abstract function tableName(): string;

    /**
     * Return array of names property for save in DB.
     * Must include parent's fields.
     *
     * @return array
     */
    public static function fieldsDB(): array
    {
        return [
            'id'
        ];
    }

    /**
     * Get id of this record.
     * If record has not been saved, then returns null.
     *
     * @return int|null
     */
    public final function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Find all records with $condition.
     * $condition is SQL-expression that use in WHERE statement.
     *
     * @global mysqli $mysqli
     * @param string $condition
     * @return array
     */
    public static function find(string $condition = ''): array
    {
        global $mysqli;
        $table = static::tableName();
        if ($condition !== '') {
            $condition = "WHERE $condition";
        }
        $result = $mysqli->query("SELECT * FROM $table $condition");
        $allRecord = [];
        while ($row = $result->fetch_assoc()) {
            $record = new static();
            foreach ($record->fieldsDB() as $field) {
                $record->$field = $row[$field];
            }
            array_push($allRecord, $record);
        }
        return $allRecord;
    }

    /**
     * Find a person whith $id.
     *
     * @param int $id
     * @return self|null
     */
    public static function findById(int $id): ?self
    {
        return static::find("id = $id")[0];
    }

    /**
     * Save record.
     * @global mysqli $mysqli
     * @return void
     */
    public function save(): void
    {
        global $mysqli;

        $table = static::tableName();
        $fields = static::fieldsDB();
        $shieldingData = [];
        foreach ($fields as $field) {
            if ($this->$field === null) {
                $shieldingData += [
                    $field => 'NULL'
                ];
                continue;
            }
            $shieldingData += [
                $field => '"' . $mysqli->escape_string($this->$field) . '"'
            ];
        }

        if (is_numeric($this->id)) {
            $set = [];
            foreach ($fields as $field) {
                array_push($set, $field . '=' . $shieldingData[$field]);
            }
            $set = implode(', ', $set);
            $mysqli->query("UPDATE $table SET $set WHERE id = {$this->id}");
            return;
        }

        $cols = implode(', ', $fields);
        $values = implode(', ', $shieldingData);
        $mysqli->query("INSERT INTO $table ($cols) VALUES ($values)");
        $result = $mysqli->query("SELECT MAX(id) AS id FROM $table");
        $this->id = $result->fetch_assoc()['id'];
    }

    /**
     * Delete this record from DB
     *
     * @global mysqli $mysqli
     * @return void
     */
    public function delete(): void
    {
        if (!is_numeric($this->id)) {
            return;
        }
        global $mysqli;
        $table = static::tableName();
        $mysqli->query("DELETE $table WHERE id = {$this->id}");
        $this->id = null;
    }
}