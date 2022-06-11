<?php 

require_once("../../db/connection/connect.php");
require_once("../libs/create_user_session.php");

session_start();
/*// if there is no session set but there are cookies set
if (!isset($_SESSION["user"]) && isset($_COOKIE["username"]) && isset($_COOKIE["password"])) {
    $user = ["username" => $_COOKIE["username"], "password" => $_COOKIE["password"]]; 
    $response = createUserSession($user);

    if ($response["status"] == "error") { 
        http_response_code($response["code"]);
        exit(json_encode(["status" => $response["status"], "message" => $response["message"]]));
    }
}
// if there is no session and at least one cookie is missing return an error
else if (!isset($_SESSION["user"]) && (!isset($_COOKIE["username"]) || !isset($_COOKIE["password"]))) {
    http_response_code(401);
    exit(json_encode(["status" => "UNAUTHENTICATED", "message" => "Потребителят не е автентикиран!"]));
}*/

$user_id = $_SESSION["user"]["id"];

try {
    $db = new DB();
    $connection = $db->getConnection();

    $selectQ = "SELECT username,password,full_name,email,fn,graduation,major,groupN FROM users WHERE id = :id";

    $stmt = $connection->prepare($selectQ);
    $stmt->execute(["id" => $user_id]);

    $user_data = $stmt->fetch(PDO::FETCH_ASSOC);
    
    http_response_code(200);
    exit(json_encode(["status" => "success", "data" => $user_data]));
}
catch (PDOException $e) {
    http_response_code(500);
    exit(json_encode(["status" => "error", "message" => "Неочаквана грешка настъпи в сървъра!"]));
}

?>