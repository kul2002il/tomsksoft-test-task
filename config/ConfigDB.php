<?php

namespace config;

class ConfigDB
{
    public function getConfig()
    {
        return [
            'host' => 'localhost',
            'database' => 'test_task',
            'username' => 'root',
            'password' => '',
        ];
    }
}