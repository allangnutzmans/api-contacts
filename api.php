<?php

require 'database.php';

// RESPONSE LOGIC
$param = [];
parse_str($_SERVER['QUERY_STRING'], $endpoint); // transformar endpoint em pars_str
parse_str($_SERVER['QUERY_STRING'], $param);
api_response($endpoint, $param);

function api_response($endpoint, $param) {
    $method = $_SERVER['REQUEST_METHOD'];
    $data = ['method' => $method,
            'endpoint' => $endpoint,
            'data' => api_methods($endpoint, $method,  $param)
        ];
    header("Content-Type:application/json"); // This means that the browser will interpret the response as JSON data
    echo json_encode($data); // return the JSON of the object data;
}

//methods = ['GET', 'POST', 'PATCH', 'DELETE'];
function api_methods($endpoint, $method, $param)
{
    // GET (read)
    if ($method == 'GET' && (count($param) == 1)) {
        return get_all_contacts($endpoint);
    }elseif ($method == 'GET' && (count($param)) > 1){
        return get_contact($endpoint, $param);
    }

    // POST
    if ($method == 'POST') {
        return post_method($endpoint, $param);

    }
    return [
        'status' => 'FAIL',
        'message' => 'NON-EXISTENT ENDPOINT',
    ];
}
//ENDPOINTS
function get_all_contacts($endpoint)
{
    if ($endpoint['endpoint'] == 'status' || $endpoint == null) {
        return [
            'status' => 'SUCCESS',
            'message' => 'API RUNNING OK!',
        ];
    }
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

function get_contact($endpoint, $params){
        //More query string parameters
        $query = 'SELECT * FROM contacts WHERE';
        $column = [];
        if (array_key_exists('name', $params)) {
            if(filter_var($params['name']))
            $column[] = "name LIKE '%". $params['name'] . "%'";
        }
        if (array_key_exists('address', $params)) {
            $column[] = "address LIKE '%". $params['address'] . "%'";
        }
        if (array_key_exists('phone', $params)) {
            $column[] = "phone LIKE '%" . $params['phone'] . "%'";
        }

        if (!empty($column)) {
                $query .= ' ' . implode(' OR ', $column); //AND (specific) e OR (all) colocar uma função para colocar o and
                return [
                    'status' => 'SUCCESS',
                    'message' => 'Results of your search: ',
                    'db_data' => QUERY_EXE($query),
                ];
            }
        if (array_key_exists('id', $params)){
            if (filter_var('id', FILTER_VALIDATE_INT)){
                $query .= "AND id = ". intval($params['id']);
                return [
                    'status' => 'SUCCESS',
                    'message' => 'Results of your search: ',
                    'db_data' => QUERY_EXE($query),
                ];
            }
        }

    return [
        'status' => 'FAIL',
        'message' => 'NON-EXISTENT ENDPOINT',
    ];
}

function post_method($endpoint, $param = [])
{
    if ($endpoint == 'status') {
        return [
            'status' => 'SUCCESS',
            'message' => 'API RUNNING OK!',
        ];
    }
    if ($endpoint == 'contact' || $endpoint == null) {
        return [
            'status' => 'SUCCESS',
            'message' => 'API connected to the DB',
            'db_data' => QUERY_EXE("SELECT * FROM contacts"),
        ];
    }
    //More query string parameters
    $param['name'] = $_POST['name'] ?? "";
    $param['address'] = $_POST['address'] ?? "";
    $param['phone'] = $_POST['phone'] ?? "";
    //parse_str($_SERVER['QUERY_STRING'], $param); //deixa passar qqlr string por isso OFF
    $query = 'SELECT * FROM contacts WHERE 1';
    $column = [];
    if (!empty($param['name'])) {
        $column[] = "name LIKE '%". $param['name'] . "%'";
    }
    if (!empty($param['address'])) {
        $column[] = "address LIKE '%". $param['address'] . "%'";
    }
    if (!empty($param['phone'])) {
        $column[] = "phone LIKE '%" . $param['phone'] . "%'";
    }
    if (!empty($column)){
        $query .= ' ' .implode(' AND ', $column); //AND (specific) e OR (all) colocar uma função aqui ou crar uma nova função //um botao que vem do front
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

