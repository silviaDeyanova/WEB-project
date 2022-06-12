<?php

require_once('../libs/create_user_session.php');


// $params = file_get_contents("php://input");
// $user = json_decode($params, true);
$user = json_decode(file_get_contents('php://input'), true);

$username = null;
$password = null;
if (isset($user['username']) && isset($user['password'])) {
    $username = $user["username"];
    $password = $user["password"];
}

$userObject = ["username" => $username, "password" => $password];
$response = createUserSession($userObject);
http_response_code($response["code"]);
echo json_encode(["status" => $response["status"], "message" => $response["message"]], JSON_UNESCAPED_UNICODE);
// echo json_encode(["status" => $userObject, "message" => $response["message"]], JSON_UNESCAPED_UNICODE);
