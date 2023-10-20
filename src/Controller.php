<?php

namespace main\src;

class Controller
{
    public function runAction($action){
        $action .= 'Action';
        if (method_exists($this, $action)) {
            $this->runAction();
        } else {
            return 'Invalid action';
        }
    }
}