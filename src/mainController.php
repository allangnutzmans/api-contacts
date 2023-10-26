<?php
require 'database.php';
class mainController
{
    protected $status;
    protected $method;
    private $endpoint;
    protected $db;


    public function __construct()
    {
        $this->status = 'API RUNNING OK';
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->endpoint = $_SERVER['QUERY_STRING'];
        $this->db = new database();
    }
    /*
    public function runMethod(){
        if (in_array($this->method, self::ALLOW_METHODS)){
            $methodName = ucfirst(strtolower($_SERVER['REQUEST_METHOD']));
            $classname = $methodName .= 'Method';
            $class = new $classname();
            $class->$methodName();
        } else {
            $data = ['status' => $this->status,
                'connection' => $this->connection,
                'method' => $this->method,
                'endpoint' => $this->endpoint,
                'message' => 'Invalid endpoint or method'
            ];
            var_dump($data);
            header("Content-Type:application/json");
            echo json_encode($data, true);
        }
    }
*/
    public function statusResponse($message){
        $status = ['status' => $this->status,
                   'method' => $this->method,
                    'endpoint'=> $this->endpoint,
            ];
        if ($message){
             $status['message'] = $message;
        }
        return $status;
    }

    protected function Response($data = null, $message = null)
    {
        $response = [$this->statusResponse($message)];
        if (!empty($data)){
            $response['data'] = $data;
        }

        header("Content-Type:application/json");
        echo json_encode($response, true);
    }

}