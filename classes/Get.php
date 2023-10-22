<?php

namespace api\classes;
use http\Message;

require 'Response.php';
require 'DB_CONN.php';

class Get extends \api\classes\Response
{
    private $db;
    public function __construct(){
        $this->status = 'API RUNINNG OK!';
        $this->connection = 'keep-alive';
        $this->setMethod();
        $this->endpoint = $_SERVER['QUERY_STRING'];
        $this->db = new DB_CONN();
    }

    public function get_all_endpoints(){
        $query = 'SELECT * FROM contacts';
        $stmt = $this->db->conn->prepare($query);
        $stmt->execute();
        $this->data = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return [ 'status' => $this->status,
                'connection' => $this->connection,
                'method' => $this->method,
                'data' => [$this->data]
        ];
    }

    public function get_contact() {
        $query = 'SELECT * FROM contacts' . intval($this->endpoint);
        $stmt = $this->db->conn->prepare($query);
        $stmt->execute();
        $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        if ($data){ //se o id existe
            return [ 'status' => $this->status,
                'connection' => $this->connection,
                'method' => $this->method,
                'data' => [$this->data]
            ];
        }else{
            return [ 'status' => $this->status,
                'connection' => $this->connection,
                'method' => $this->method,
                'message' => 'UNABLE TO LOCATE CONTACT'
                ];
        }
    }

}