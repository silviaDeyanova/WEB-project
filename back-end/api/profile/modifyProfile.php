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
        $sql = "UPDATE users SET password = :password, graduation = :graduation, major = :major, groupN = :groupN WHERE username = " . $username;
        $updateUser = $connection->prepare($sql);
        echo json_encode(["status" => "success", "message" => "Успешна промяна!"], JSON_UNESCAPED_UNICODE);
        $updateUser->execute(["password" => $password, "graduation" => $graduation, "major" => $major, "groupN" => $groupN]);
    } catch (PDOException $e) {
        return json_encode(["status" => "error", "message" => "Възникна грешка при промяната на профила!"], JSON_UNESCAPED_UNICODE);
    }
}
