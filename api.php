<?php

require 'database.php';

// RESPONSE LOGIC
$param = [];
parse_str($_SERVER['QUERY_STRING'], $endpoint); // transformar endpoint em pars_str
api_response($endpoint, $param);

function api_response($endpoint) {
    $method = $_SERVER['REQUEST_METHOD'];
    $data = ['method' => $method,
            'endpoint' => $endpoint,
            'data' => api_methods($endpoint, $method)
        ];
    header("Content-Type:application/json"); // This means that the browser will interpret the response as JSON data
    echo json_encode($data); // return the JSON of the object data;

}

//methods = ['GET', 'POST', 'PATCH', 'DELETE'];
function api_methods($endpoint, $method)
{
    if ($endpoint['endpoint'] == 'status') {
        return [
            'status' => 'SUCCESS',
            'message' => 'API RUNNING OK!',
        ];
    }
    // GET (read)
    if (($method == 'GET' && (count($endpoint) == 1)) || $endpoint == null) {
        return get_all_contacts($endpoint);

    }//elseif (){}
    elseif ($method == 'GET' && (count($endpoint)) > 1){
        return get_contact($endpoint);
    }
    // POST
    if ($method == 'POST') {
        return post_new_contact($endpoint);
    }

    if ($method == 'PUT'){
        return put_contact($endpoint);
    }

    if($method == 'DELETE'){
        return delete_contact($endpoint);
    }

    return [
        'status' => 'FAIL',
        'message' => 'failed to process the request',
    ];
}
//ENDPOINTS
function get_all_contacts($endpoint)
{
    if ($endpoint['endpoint']== 'contact') {
        return [
            'status' => 'SUCCESS',
            'message' => 'API connected to the DB',
            'db_data' => QUERY_EXE("SELECT * FROM contacts"),
        ];
    }
    return [
        'status' => 'FAIL',
        'message' => 'NON-EXISTENT ENDPOINT',
    ];
}

function get_contact($endpoint){
    $query = "SELECT * FROM contacts WHERE id=" . intval($endpoint['id']);
    return [
        'status' => 'SUCCESS',
        'message' => 'Results of your search: ',
        'db_data' => QUERY_EXE($query),
    ];
    /*
    return [
        'status' => 'FAIL',
        'message' => 'NON-EXISTENT ENDPOINT',
    ];
    */
}

function post_new_contact($endpoint)
{
        $query = "INSERT INTO contacts(name, address, phone) VALUES('" . $endpoint['name'] . "', '" . $endpoint['address'] . "', " . $endpoint['phone'] . ")";
        $new_contact = QUERY_EXE($query);
        return [
            'status' => 'SUCCESS',
            'message' => 'New contact created:',
            'NEW' => json_encode($new_contact) // Concertar dps
        ];
}

function put_contact($endpoint){
    $query = "SELECT * FROM contacts WHERE id =" . intval($endpoint['id']);
    $old_data = QUERY_EXE($query);
    if (array_key_exists('id', $endpoint)) {
        $query = "UPDATE contacts SET name = '" . $endpoint['name'] . "', address = '" . $endpoint['address'] . "', phone = '" . $endpoint['phone'] . "' WHERE id = " . intval($endpoint['id']);

        return [
            'status' => 'SUCCESS',
            'message' => 'endpoint id matches:',
            'old_data' => $old_data,
        ];
    } else {
        return [
            'status' => 'FAIL',
            'message' => 'Cannot locate id' . intval($endpoint['id']),
        ];
    }


}

function delete_contact($endpoint)
{
    if (array_key_exists('id', $endpoint)) {
        $query = "DELETE FROM contacts WHERE id =" . intval($endpoint['id']);

        return QUERY_EXE($query);
    }
    return [
        'status' => 'FAIL',
        'message' => 'Could not locate the requested id',
    ];
}