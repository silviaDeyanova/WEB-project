<?php 

require_once("../../db/connection/connect.php");
require_once("../libs/create_user_session.php");

session_start();
$user_id = $_SESSION["user"]["id"];

try {
    $db = new DB();
    $connection = $db->getConnection();

    $selectQ = "SELECT username,password,full_name,fn,email,graduation,major,groupN FROM users WHERE id = :id";

    $stmt = $connection->prepare($selectQ);
    $stmt->execute(["id" => $user_id]);

    $user_data = $stmt->fetch(PDO::FETCH_ASSOC);
    
    http_response_code(200);
    exit(json_encode(["status" => "success", "data" => $user_data]));
}
catch (PDOException $e) {
    http_response_code(500);
    exit(json_encode(["status" => "error", "message" => "Грешка в сървъра!"]));
}

?>
