<?php

require_once('../back-end/db/connection/connect.php');

$params = file_get_contents('php://input');
$data = json_decode($params, true);

$topic_name = $data["topic_name"]; // get input topic
$topic_subject = $data["topic_subject"]; // get topic info
$topic_by=3;

/*$username = "arhalachev";
//$topic_date = date("Y-m-d H:i:s"); // get topic info
//$topic_by=2;
$topic_by = "SELECT id 
               FROM users 
               WHERE username = :username";
*/

try {
    $db = new DB();
    $connection = $db->getConnection();
    
    /*$query = "SELECT * 
               FROM users 
               WHERE username = :username";

    $statement = $connection->prepare($query);
    $statement->execute(["username" => $username]);

    if ($statement->rowCount() != 0) {
        http_response_code(400);
        exit(json_encode(["status" => "error", "message" => "Потребител с такова потребителско име вече съществува!"], JSON_UNESCAPED_UNICODE));
    }*/
    
} catch (PDOException $e) {
    http_response_code(500);
    return json_encode(["status" => "error", "message" => "Възникна грешка при регистрацията!"], JSON_UNESCAPED_UNICODE);
}

try {
    $insert = "INSERT INTO topics (topic_name, topic_subject,topic_by)
    VALUES (:topic_name, :topic_subject, :topic_by)";

    $statement = $connection->prepare($insert);

    if ($statement->execute([
        "topic_name" => $topic_name,
        "topic_subject" => $topic_subject,
        "topic_by" => $topic_by,
    ])) {

       /* $userId = $connection->lastInsertId();
        session_start();
        $user = ["id" => $userId, "username" => $username, "password" => $hashedPassword, "full_name" => $fullName, "fn" => $fn, "email" => $email];
        $_SESSION["user"] = $user;

        setcookie("user", $username, time() + 60 * 60 * 2, "/");
        setcookie("password", $password, time() + 60 * 60 * 2, "/");

        http_response_code(201);
        exit(json_encode(["status" => "success", "message" => "Успешна регистрация!"], JSON_UNESCAPED_UNICODE));*/
    } else {
        http_response_code(500);
        exit(json_encode(["status" => "error", "message" => "Възникна грешка при регистрацията!"], JSON_UNESCAPED_UNICODE));
    }
} catch (PDOException $e) {
    http_response_code(500);
    exit(json_encode(["status" => "error", "message" => "Възникна грешка при регистрацията!"], JSON_UNESCAPED_UNICODE));
}


?>