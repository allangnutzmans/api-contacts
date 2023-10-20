<?php

namespace api\classes;
require 'Response.php';

class Get extends \api\classes\Response
{
    public function __construct(){
        $this->status = 'API RUNINNG OK!';
        $this->connection = 'keep-alive';
        $this->method
        get_all_contacts();
    }

    public function get_all_endpoints(){

        return [ 'method' => $this->method,

                ];
    }

    public function get_contact{

    }

}