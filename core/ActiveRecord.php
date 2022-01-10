<?php
namespace core;

abstract class ActiveRecord
{

    private $id;

    public static abstract function tableName(): string;

    public static function fielsdDB(): array
    {
        return [
            'id'
        ];
    }

    public final function getId(): ?int
    {
        return $this->id;
    }

    public static final function find(string $condition = ''): array
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
            foreach ($record->fielsdDB() as $field) {
                $record->$field = $row[$field];
            }
            array_push($allRecord, $record);
        }
        return $allRecord;
    }

    public static function findById(int $id): self
    {
        return static::find("id = $id")[0];
    }

    public final function save(): void
    {
        global $mysqli;

        $table = static::tableName();
        $fields = static::fielsdDB();
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
