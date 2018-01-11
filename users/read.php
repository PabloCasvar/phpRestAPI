<?php

//required headers 
header("Access-Control-Allow_Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../objects/User.php';

$database = new Database();
$db = $database->getConnection();

$users = new User($db);

$stmt = $users->readAll();
$num = $stmt->rowCount();

if($num>0){
    $users_arr=array();
    $users_arr['records']=array();

    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $user = array(
            "username"=>$username
        );

        array_push($users_arr['records'], $user);

    }

    echo json_encode($users_arr);
} else {
    echo json_encode(
        array("message" => "No products found.")
    );
}

?>