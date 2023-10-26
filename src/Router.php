<?php
require_once 'HttpMethods.php';
require_once 'src/mainController.php';
class Router implements HttpMethods
{
    public $route;
    private const ALLOW_METHODS = ['GET', 'POST', 'PUT', 'DELETE'];
    private $method;

    private array $endpoint = [];

    public function __construct() {
        $this->route = parse_url($_SERVER['REQUEST_URI']);
        $this->method = $_SERVER['REQUEST_METHOD'];
        parse_str($_SERVER['QUERY_STRING'], $this->endpoint);
        $this->getRoute();
        $this->postRoute($this->endpoint);
        $this->deleteRoute();
        $this->putRoute();
    }

    public function getRoute(){
        if ($this->method == 'GET') {
            require 'controller/GetMethod.php';
            $get = new GetMethod();
            if (array_key_exists('id', $this->endpoint)) {
                $id = $this->endpoint['id'];
                $get->ReadById($id);
            } elseif ($this->route['path'] == '/contacts') {
                $get->ReadAll();
            }
        }
    }


    function postRoute($endpoint)
    {
        if ($this->method == 'POST') {
            include 'controller/PostMethod.php';
            new PostMethod($endpoint);
        }
    }

    function deleteRoute()
    {
        if ($this->method == 'DELETE') {
            include 'controller/DeleteMethod.php';
            new DeleteMethod($this->endpoint);
        }
    }

    function putRoute()
    {
        if ($this->method == 'PUT') {
            include 'controller/PutMethod.php';
            new PutMethod($this->endpoint);
        }
    }
}
