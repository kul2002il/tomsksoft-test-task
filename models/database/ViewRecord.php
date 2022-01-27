<?php

namespace models\database;

abstract class ViewRecord
{
    protected \PDO $connection;

    public function __construct()
    {
        $this->connection = ConnectionPDO::getInstance()->getConnection();
    }

    public abstract function tableName(): string;

    public abstract function fields(): array;

    private function find(string $condition = '')
    {
        $where = '';
        if($condition !== '')
        {
            $where = "WHERE $condition";
        }
        $table = $this->tableName();
        $cols = implode(', ', $this->fields());
        return $this->connection->query("SELECT $cols FROM $table $where");
    }

    public function findAssoc(string $condition = ''): array
    {
        return $this->find($condition)->fetchAll(\PDO::FETCH_ASSOC);
    }
}