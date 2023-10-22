<?php

namespace api\classes;
require 'database.php';

abstract class Response {

    public $status;
    public $connection;
    protected $method;
    public $endpoint;
    protected array $data;
    public function setMethod(){
        $this->method = $_SERVER['REQUEST_METHOD'];
        if ($this->method == 'GET'){

        }
    }
    public function getMethod(){
        return $this->method;
    }
    public function setEndpoint($endpoint){
        $this->endpoint = $endpoint;
    }

    public function getEndpoint(){
        return $this->endpoint;
    }
}