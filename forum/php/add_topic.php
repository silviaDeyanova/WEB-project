<?php

require_once('../back-end/db/connection/connect.php');

$params = file_get_contents('php://input');
$data = json_decode($params, true);


$topic = $data["topic"]; // get input topic
$topic_info = $data["topic_info"]; // get topic info
$topic_by = "3";
//$topic_date=date("h:i:sa");  $connection->lastInsertId();


/*try {
    $insert = "INSERT INTO topics (topic_name, topic_subject)
                      VALUES (:topic, :topic_info)";

    $statement = $connection->prepare($insert);

} catch (PDOException $e) {
    http_response_code(500);
    exit(json_encode(["status" => "error", "message" => "Възникна грешка при регистрацията!"], JSON_UNESCAPED_UNICODE));
}
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
    }
    */
} catch (PDOException $e) {
    http_response_code(500);
    return json_encode(["status" => "error", "message" => "Възникна грешка"], JSON_UNESCAPED_UNICODE);
}

try {
    $insert = "INSERT INTO topics (topic_name, topic_subject,topic_by)
                      VALUES (:topic, :topic_info, :topic_by)";

    $statement = $connection->prepare($insert);

    if ($statement->execute([
        "topic_name" => $topic,
        "topic_subject" => $topic_info,
        "topic_by" => $topic_by
    ])) {
        
        $userId = $connection->lastInsertId();
        session_start();
        $user = ["id" => $userId, "username" => $username, "password" => $hashedPassword, "full_name" => $fullName, "fn" => $fn, "email" => $email];
        $_SESSION["user"] = $user;

        setcookie("user", $username, time() + 60 * 60 * 2, "/");
        setcookie("password", $password, time() + 60 * 60 * 2, "/");
        
        http_response_code(201);
        exit(json_encode(["status" => "success", "message" => "Успешна регистрация!"], JSON_UNESCAPED_UNICODE));
    } 
    else {
        http_response_code(500);
        exit(json_encode(["status" => "error", "message" => "Възникна грешка при регистрацията!"], JSON_UNESCAPED_UNICODE));
    }
} catch (PDOException $e) {
    http_response_code(500);
    exit(json_encode(["status" => "error", "message" => "Възникна грешка при регистрацията!"], JSON_UNESCAPED_UNICODE));
}


?>
