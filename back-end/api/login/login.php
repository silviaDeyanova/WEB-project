<?php

require_once('../libs/create_user_session.php');

function login()
{
    // $params = file_get_contents("php://input");
    // $user = json_decode($params, true);
    // $username = $user["username"];
    // $password = $user["password"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $userObject = ["username" => $username, "password" => $password];
    $response = createUserSession($userObject);
    http_response_code($response["code"]);
    exit(json_encode(["status" => $response["status"], "message" => $response["message"]]));
}

?>