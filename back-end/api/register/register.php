<?php

require_once('../../db/connection/connect.php');

$params = file_get_contents('php://input');
$data = json_decode($params, true);

// $username = $_POST['username'];
// $password = $_POST['password'];
// $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
// $email = $_POST['email'];
// $fullName = $_POST['fullName'];
// $fn = $_POST['fn'];
$username = $data['username'];
$password = $data['password'];
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
$email = $data['email'];
$fullName = $data['fullName'];
$fn = $data['fn'];

try {
    $db = new DB();
    $connection = $db->getConnection();

    $query = "SELECT * 
               FROM users 
               WHERE username = :username";

    $statement = $connection->prepare($query);
    $statement->execute(["username" => $username]);

    if ($stmt->rowCount() != 0) {
        http_response_code(400);
        exit(json_encode(["status" => "error", "message" => "Потребител с такова потребителско име вече съществува!"]));
    }
} catch (PDOException $e) {
    http_response_code(500);
    return json_encode(["status" => "error", "message" => "Възникна грешка при регистрацията!"]);
}

try {
    $insert = "INSERT INTO users (username, password, full_name, fn, email)
                      VALUES (:username, :password, :full_name, :fn, :email)";

    $statement = $connection->prepare($insert);

    if ($statement->execute([
        "username" => $username,
        "password" => $hashedPassword,
        "full_name" => $fullName,
        "fn" => $fn,
        "email" => $email
    ])) {

        $userId = $connection->lastInsertId(); // get the newly created user's id
        session_start();
        $user = ["id" => $userId, "username" => $username, "password" => $hashedPassword, "full_name" => $fullName, "fn" => $fn, "email" => $email];
        $_SESSION["user"] = $user;

        setcookie("user", $username, time() + 60 * 60 * 2, "/");
        setcookie("password", $password, time() + 60 * 60 * 2, "/");

        http_response_code(201);
        exit(json_encode(["status" => "success", "message" => "Успешна регистрация!"]));
    } else {
        http_response_code(500);
        exit(json_encode(["status" => "error", "message" => "Възникна грешка при регистрацията!"]));
    }
} catch (PDOException $e) {
    http_response_code(500);
    exit(json_encode(["status" => "error", "message" => "Възникна грешка при регистрацията!"]));
}

?>
