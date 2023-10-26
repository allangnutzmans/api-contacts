<?php

 class GetMethod extends mainController {

     public function ReadAll(){
             $data = $this->db->QUERY_EXE('SELECT * FROM contacts');
             $this->response($data);
     }

     public function ReadById($id){
             $data = $this->db->QUERY_EXE("SELECT * FROM contacts WHERE id =" . $id);
             $this->response($data);
     }

 }