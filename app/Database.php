<?php

namespace App;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Exception;

class Database
{
    private static $connection = null;

    public static function connection(): ?Connection
    {
        if(self::$connection === null)
        {
            $connectionParams = [
                'dbname' => 'store',
                'user' => 'root',
                'password' => '',
                'host' => 'localhost',
                'driver' => 'pdo_mysql',
            ];
            try {
                self::$connection = DriverManager::getConnection($connectionParams);
            } catch (Exception $e) {
            }
        }
        return self::$connection;
    }
}
