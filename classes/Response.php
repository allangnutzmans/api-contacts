<?php

namespace api\classes;

abstract class Response {

    public $status;
    public $connection;
    public $method = parse_str($_SERVER['REQUEST_METHOD'], $endpoint); //precisa mesmo, já ta no nome da classe
    private $endpoint;
    protected $data;

    private function setMehod(){
        $this->method = parse_str($_SERVER['REQUEST_METHOD'], $this->method);
    }
    public function setEndpoint($endpoint){
        $this->endpoint = $endpoint;
    }

    public function getEndpoint(){
        return $this->endpoint;
    }
}