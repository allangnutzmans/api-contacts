<?php
class DeleteMethod extends mainController {

    public function __construct($endpoint)
    {
        parent::__construct();
        $this->deleteEndpoint($endpoint);
    }

    private function deleteEndpoint($endpoint)
    {
        if (array_key_exists('id', $endpoint)) {
            $id = $endpoint['id'];
            $query = "SELECT * FROM contacts WHERE id =" . $id;
            if ($this->db->ROW_COUNT($query) > 0){
                $query = "DELETE FROM contacts WHERE id =" . $id;
                $this->db->QUERY_EXE($query);
                $message = 'Endpoint id = ' . $id . ' deleted.';
            } else {
                $message = 'Unreachable endpoint id = ' . $id;
            }
            $this->Response(null, $message);

        }
    }


}