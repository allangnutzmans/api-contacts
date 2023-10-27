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

        if (!empty($endpoint)) {
            $id = $endpoint['id'];
            $query = "SELECT * FROM contacts WHERE id =" . $id;
            $data = $this->db->QUERY_EXE("SELECT * FROM contacts WHERE id =" . $id);
            if ($this->db->ROW_COUNT($query) > 0) {
                foreach ($endpoint as $field => $value) {
                    $query = "UPDATE contacts SET `$field` = '" . $value . "' WHERE id = " . $id;
                    $this->db->QUERY_EXE($query);
                }
                $message = "CONTACT id = $id UPDATED!";
                $data = $this->db->QUERY_EXE("SELECT * FROM contacts WHERE id =" . $id);
            } else {
                $data = null;
                $message = "UNREACHABLE ENDPOINT id = $id .";
            }
        } else {
            $data = null;
            $message = 'NOTHING TO UPDATE.';
        }
        $this->response($data, $message);
    }

}