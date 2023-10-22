<?php

define('ROOT_PATH', dirname(__FILE__) . DIRECTORY_SEPARATOR);
require ROOT_PATH . 'classes/Get.php';

$request = new api\classes\Get();
    if ($request->endpoint == 'contacts/'){
        return $request->get_all_endpoints();
    }


echo json_encode($request->get_contact(), true);


