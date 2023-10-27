<?php

require_once 'controller/GetMethod.php';
class PostMethod extends mainController {
    public function __construct($param)
    {
        parent::__construct();
        $this->CreateEndpoint($param);
    }

    private function CreateEndpoint ($param){
        if (empty($param['name']) || empty($param['address']) || empty($param['phone'])){
            $data = null;
            $message = 'INVALID DATA PARAMS. USE: name, address, and phone.';
        } else {
            $query = "INSERT INTO contacts (name, address, phone) VALUES ('" . $param['name'] . "', '" . $param['address'] . "', '" . $param['phone'] . "')";
            $this->db->QUERY_EXE($query);
            $data = $this->db->QUERY_EXE("SELECT * FROM contacts WHERE name = '" . $param['name'] . "' AND address = '" . $param['address'] . "' AND phone = '" . $param['phone'] . "'");
            $message = "NEW CONTACT " . $param['name'] . " ADDED!";
        }
        $this->response($data, $message);

    }

}