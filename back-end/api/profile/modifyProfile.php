<?php
require_once("../../db/connection/connect.php");

header("Access-Control-Allow-Origin: *"); 
header('Content-Type: application/json');

$phpInput = json_decode(file_get_contents('php://input'), true);

if (empty($phpInput['username']) || empty($phpInput['password'])) {
    echo json_encode([
        "status" => "error",
        "message" => "Моля, попълнете полетата!",
    ], JSON_UNESCAPED_UNICODE);
} else {
    $username = $phpInput['username'];
    $password = $phpInput['password'];
    $graduation = $phpInput['graduation'];
    $major = $phpInput['major'];
    $groupN = $phpInput['groupN'];


    try {
        $db = new DB();
        $connection = $db->getConnection();
        $sql = "UPDATE users SET groupN = :groupN WHERE username = " . $username;
        $updateUser = $connection->prepare($sql);
        if($updateUser->execute(["password" => password_hash($password, PASSWORD_DEFAULT), "graduation" => $graduation, "major" => $major, "groupN" => $groupN])){
            http_response_code(201);
            echo json_encode([
                "status" => "success",
                "message" => "Профилът ви е обновен успешно!",
            ], JSON_UNESCAPED_UNICODE);
        }
        else{
            http_response_code(400);
            echo json_encode(["status" => "success", "message" => "Успешна промяна!"], JSON_UNESCAPED_UNICODE);
        }
    } catch (PDOException $e) {
        return json_encode(["status" => "error", "message" => "Възникна грешка при промяната на профила!"], JSON_UNESCAPED_UNICODE);
    }
}
