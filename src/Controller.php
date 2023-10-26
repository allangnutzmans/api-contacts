<?php

namespace main\src;
use config\DB_CONN;

require ROOT_PATH . 'vendor/autoload.php';
class Controller
{
    protected $db;
    private const AVAILABLE_METHODS = ['GET', 'POST', 'PUT', 'DELETE'];
    public function __construct()
    {
        $this->db = new DB_CONN();
    }

    public function runMethod($method) : void
    {
        if (in_array($method, self::AVAILABLE_METHODS)) {
            $action = strtolower($method);
            $action .= 'Action';
            if (method_exists($this, $action)) {
                $this->$action();
            }
        }
    }
}

