<?php

require_once('../back-end/db/connection/connect.php');

$params = file_get_contents('php://input');
$data = json_decode($params, true);

$topic_name = $data["topic_name"]; // get input topic
$topic_subject = $data["topic_subject"]; // get topic info
$topic_by = 3;


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





/*function isUserDataValid($userData) {
    if (!isset($userData["topic"]) || !isset($userData["topic_info"])) {
        return ["isValid" => false, "message" => "Некоректни данни!"];
    }

    //$regex = "/^[a-z0-9_]+@[a-z]+\.[a-z]+$/";

    if (!preg_match($regex, $userData["email"])) {
        return ["isValid" => false, "message" => "Невалиден имейл!"];
    }

    return ["isValid" => true, "message" => "Данните са валидни!"];
}

function getStudentsRoleId(PDO $connection) {
    $userId = $connection->lastInsertId();
    //$sql = "SELECT id FROM users WHERE username = :username" ";
    $stmt = $connection->query($userId);
    $id = $stmt->fetch(PDO::FETCH_ASSOC)["id"];
    return $id;
}



require_once('../back-end/db/connection/connect.php');
$userData = json_decode(file_get_contents("php://input"), true);

if ($userData) {

    $valid = isUserDataValid($userData);

    if (!$valid["isValid"]) {
        http_response_code(400);
        exit(json_encode(["status" => "ERROR", "message" => $valid["message"]]));
    }

    $userData["password"] = password_hash($userData["password"], PASSWORD_DEFAULT);

    try {

        $db = new DB();
        $connection = $db->getConnection();
        $userId = getStudentsRoleId($connection);

        //$userId = 3;
       
        $userData += ["topic_by" => $userId];

        $sql = "INSERT INTO users (topic_name, topic_subject,topic_by) 
                VALUES (:topic, :topic_info, :topic_by)";

        $stmt = $connection->prepare($sql);
        $stmt->execute($userData);

        echo json_encode(["status" => "SUCCES", "message" => "Регистрацията е успешна"]);

    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(["status" => "ERROR", "message" => "Грешка при регистрация!"]);
    }


} else {
    http_response_code(400);
    echo json_encode(["status" => "ERROR", "message" => "Некоректни данни!"]); 
}
?>
*/
?>