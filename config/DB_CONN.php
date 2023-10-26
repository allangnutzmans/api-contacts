<?php

namespace config;
class DB_CONN
{
    public $conn;
    public function __construct()
    {
        $dsn = "mysql:dbname=contacts;host=127.0.0.1;";
        $user = 'allan';
        $password = 'admin';
        $this->conn = new \PDO($dsn,$user, $password, array(\PDO::ATTR_PERSISTENT => true));
    }

}