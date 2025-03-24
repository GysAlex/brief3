<?php

namespace Config;

define('DATABASE_HOST', "localhost");
define('DATABASE_NAME', "gestion_projet");
define('DATABASE_USER', "root");
define('DATABASE_PASSWORD', '');

class Database
{
    public static function getConnection()
    {   

        $options = [
            \PDO::ATTR_CASE => \PDO::CASE_LOWER,
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
        ];

        try
        {
            return  new \PDO('mysql:host=' . DATABASE_HOST . ';dbname='. DATABASE_NAME .';charset=utf8mb4', DATABASE_USER, DATABASE_PASSWORD, $options);

        }
        
        catch(\PDOException $e)
        {
            die("Erreur ".$e->getMessage());
        }

    }

}


