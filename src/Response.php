<?php
namespace main\src;

require 'database.php';

class Response
{
    private $status;
    private $connection;
    private $method;
    private $endpoint;

    private $request;

    protected array $data;


    public function __construct($request)
    {
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->endpoint['query'] = $_SERVER['QUERY_STRING'];
        $this->status = 'API RUNINNG OK!';
        $this->connection = 'keep-alive';
        $this->request = $request;
    }

    protected function response($data)
    {
        return $response = [
            'status' => $this->status,
            'connection' => $this->connection,
            'method' => $this->method,
            'endpoint' => $this->endpoint, //router
            'data' => include VIEW_PATH . '' . $this->request//definido pelo ROUTER
        ];
    }
}


