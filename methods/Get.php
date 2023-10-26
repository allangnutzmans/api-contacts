<?php

namespace Method;
use main\src\Controller;

class Get extends Controller
{

    public function getAction(){
        $data = $this->get_all_endpoints();
        $template = new \Template();
        $template->renderView($data);
    }
    public function get_all_endpoints(){
        $query = 'SELECT * FROM contacts';
        $stmt = $this->db->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function get_endpoint_id() {
        $query = 'SELECT * FROM contacts WHERE id = ' . intval($this->endpoint['id']);
        $stmt = $this->db->conn->prepare($query);
        $stmt->execute();
        $this->data = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        var_dump($this->data);
        $response = new Response();
        return $response->response($this->data);
        }

}