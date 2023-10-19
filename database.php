<?php
function QUERY_EXE($query, $params = null){

    $dsn = "mysql:dbname=contacts;host=127.0.0.1;";
    $user = 'allan';
    $password = 'admin';
    $conn = new PDO($dsn, $user, $password, array(PDO::ATTR_PERSISTENT => true));

    if($params == null){
        $stmt = $conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        $stmt = $conn->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
