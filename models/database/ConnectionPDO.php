<?php

namespace models\database;

use config\ConfigDB;

class ConnectionPDO extends Singleton
{
    private \PDO $connection;
    protected function __construct()
    {
        $configObject = new ConfigDB();
        $config = $configObject->getConfig();
        $DBH = new \PDO(
            "mysql:host={$config['host']};dbname={$config['database']}",
            $config['username'],
            $config['password']);
        $DBH->setAttribute( \PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION );
        $this->connection = $DBH;
    }

    public function getConnection(): \PDO
    {
        return $this->connection;
    }
}