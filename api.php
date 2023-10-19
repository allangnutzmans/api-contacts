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

    }elseif ($method == 'GET' && (count($endpoint)) > 1){
        return get_contact($endpoint);
    }
    // POST
    if ($method == 'POST') {
        return post_new_contact($endpoint);
    }
    return [
        'status' => 'FAIL',
        'message' => 'failed to entry new endpoint',
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
        //More query string parameters
        $query = 'SELECT * FROM contacts WHERE';
        $column = [];
        if (array_key_exists('name', $endpoint)) {
            if(filter_var($endpoint['name']))
            $column[] = "name LIKE '%". $endpoint['name'] . "%'";
        }
        if (array_key_exists('address', $endpoint)) {
            $column[] = "address LIKE '%". $endpoint['address'] . "%'";
        }
        if (array_key_exists('phone', $endpoint)) {
            $column[] = "phone LIKE '%" . $endpoint['phone'] . "%'";
        }

        if (!empty($column)) {
                $query .= ' ' . implode(' OR ', $column); //AND (specific) e OR (all) colocar uma função para colocar o and
                return [
                    'status' => 'SUCCESS',
                    'message' => 'Results of your search: ',
                    'db_data' => QUERY_EXE($query),
                ];
        }

    return [
        'status' => 'FAIL',
        'message' => 'NON-EXISTENT ENDPOINT',
    ];
}

function get_contact_by_id($endpoint)
{
    if (array_key_exists('id', $endpoint)) {
        if (filter_var($endpoint['id'], FILTER_VALIDATE_INT)) {
            var_dump($endpoint['id']);
            exit();
            $query = "SELECT * FROM contacts WHERE" . intval($endpoint['id']);
            return [
                'status' => 'SUCCESS',
                'message' => 'Results of your search: ',
                'db_data' => QUERY_EXE($query),
            ];
        }
    }
}
function post_new_contact($endpoint)
{
        $query = "INSERT INTO contacts(name, address, phone) VALUES('" . $endpoint['name'] . "', '" . $endpoint['address'] . "', " . $endpoint['phone'] . ")";
        $column = [];
        $query .= ' ' . implode(',', $column);
        $new_contact = QUERY_EXE($query);
        return [
            'status' => 'SUCCESS',
            'message' => 'New contact created:',
            'NEW' => json_encode($new_contact) // Concertar dps
        ];
}
