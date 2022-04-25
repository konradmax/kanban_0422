<?php

namespace Max\Dashboard\Common\Infrastructure;

//use \PDO;

class LocalDatabaseRepository
{
    private $database;

    public function __construct()
    {
        $this->database = new PDO($_SERVER['DB_DSN'], $_SERVER['DB_USER']);
    }

    public function get(){
        return $this->database;
    }

}