<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

include_once '../config/database.php';
include_once '../objects/User.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);
$username = isset($_GET['username']) ? $_GET['username'] : null;
$password = isset($_GET['password']) ? $_GET['password'] : null;

if($username && $password){
    $stmt = $user->getPassword($username);
    $num = $stmt->rowCount();
    
    if($num==1){
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        extract($row, EXTR_PREFIX_ALL, "db");

        if($password == $db_password){
            response_is_authorized(true);
        }else{
            response_is_authorized(false);
        }
    }else{
        response_is_authorized(false);
    }
} else {
    response_is_authorized(false);
}

function response_is_authorized($is_authorized){
    if($is_authorized){
        echo json_encode(array("authorized" => true));
    } else {
        echo json_encode(array("authorized" => false));
    }
}

?>