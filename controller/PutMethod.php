<?php

class PutMethod extends mainController
{
    public function __construct($endpoint)
    {
        parent::__construct();
        $this->UpdateById($endpoint);
    }

    public function UpdateById($endpoint)
    {
        //big if com as combinações??
        if (empty($param['name']) || empty($param['address']) || empty($param['phone'])){
            $data = null;
            $message = 'INVALID DATA PARAMS. USE: name, address, and phone.';
        } else {
            $query = "UPDATE contacts(name, address, phone) SET name = ";
            $query = " contacts (name, address, phone) VALUES ('" . $param['name'] . "', '" . $param['address'] . "', '" . $param['phone'] . "')";
            $this->db->QUERY_EXE($query);
            $data = $this->db->QUERY_EXE("SELECT * FROM contacts WHERE name = '" . $param['name'] . "' AND address = '" . $param['address'] . "' AND phone = '" . $param['phone'] . "'");
            $message = "NEW CONTACT " . $param['name'] . " ADDED!";
        }
        $this->response($data, $message);
        if (array_key_exists('id', $endpoint)) {
            $id = $endpoint['id'];
            $query = "SELECT * FROM contacts WHERE id =" . $id;
            if ($this->db->ROW_COUNT($query) > 0) {
                $query = "UPDATE contacts SET  WHERE id =" . $id;
                $this->db->QUERY_EXE($query);
                $message = 'Endpoint id = ' . $id . ' deleted.';
            } else {
                $message = 'Unreachable endpoint id = ' . $id;
            }
            $this->Response(null, $message);

        }
    }

}