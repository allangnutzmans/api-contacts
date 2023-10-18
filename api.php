<?php

require 'database.php';

// RESPONSE LOGIC
$endpoint = substr($_SERVER['QUERY_STRING'], 9); // deletes string 'endpoint'
api_response($endpoint);
function api_response($endpoint, $parameters = []) {
    $method = $_SERVER['REQUEST_METHOD'];
    $data = ['method' => $method,
            'endpoint' => $endpoint,
            'data' => api_methods($endpoint, $method, $parameters)
        ];
    header("Content-Type:application/json"); // This means that the browser will interpret the response as JSON data
    echo json_encode($data); // return the JSON of the object data;
}

//methods = ['GET', 'POST', 'PATCH', 'DELETE'];
function api_methods($endpoint, $method, $parameters)
{
    // GET (read)
    if ($method == 'GET') {
        return get_method($endpoint, $parameters);
    }
    // POST
    if ($method == 'POST') {
        return post_method($endpoint, $parameters);
    }
    return [
        'status' => 'FAIL',
        'message' => 'NON-EXISTENT ENDPOINT',
    ];
}



//ENDPOINTS
function get_method($endpoint, $parameters)
{
    if ($endpoint == 'status' || $endpoint == null) {
        return [
            'status' => 'SUCCESS',
            'message' => 'API RUNNING OK!',
        ];
    }
    if ($endpoint == 'contact') {
        return [
            'status' => 'SUCCESS',
            'message' => 'API connected to the DB',
            'db_data' => QUERY_EXE("SELECT * FROM contacts"),
        ];
    }
    if (array_key_exists('exclusive', $parameters)){

        //More query string parameters
        parse_str($_SERVER['QUERY_STRING'], $param); //deixa passar qqlr string por isso OFF
        $query = 'SELECT * FROM contacts WHERE';
        $column = [];
        if (array_key_exists('name', $param)) {
            $column[] = "name LIKE '%". $param['name'] . "%'";
        }
        if (array_key_exists('address', $param)) {
            $column[] = "address LIKE '%". $param['address'] . "%'";
        }
        if (array_key_exists('phone', $param)) {
            $column[] = "phone LIKE '%" . $param['phone'] . "%'";
        }

        if (!empty($column)) {
            if (filter_var($parameters['exclusive'], FILTER_VALIDATE_BOOL == false)) {
                $query .= ' ' . implode(' AND ', $column); //AND (specific) e OR (all) colocar uma função aqui ou crar uma nova função //um botao que vem do front
                return [
                    'status' => 'SUCCESS',
                    'message' => 'Results of your search: ',
                    'db_data' => QUERY_EXE($query),
                ];
            }
            if (filter_var($parameters['exclusive'], FILTER_VALIDATE_BOOL == true)) {
                $query .= ' ' . implode(' OR ', $column); //AND (specific) e OR (all) colocar uma função aqui ou crar uma nova função //um botao que vem do front
                return [
                    'status' => 'SUCCESS',
                    'message' => 'Results of your search: ',
                    'db_data' => QUERY_EXE($query),
                ];
            }
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
