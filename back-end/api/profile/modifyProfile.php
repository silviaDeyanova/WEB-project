<?php
require_once("../../db/connection/connect.php");

$phpInput = json_decode(file_get_contents('php://input'), true);
header('Content-Type: application/json');

    //$username = $phpInput['username'];
    $password = $phpInput['password'];
    //$fn = $phpInput['fn'];
    //$email = $phpInput['email'];
    $graduation = $phpInput['graduation'];
    $major = $phpInput['major'];
    $groupN = $phpInput['groupN'];

    //public function updateUserQuery($data)
      //  {
            //$this->database->getConnection()->beginTransaction();  
$username = sessionStorage.getItem("username");
$db = new DB();
$connection = $db->getConnection();
            try {
                $sql = "UPDATE users SET password = :password, graduation = :graduation, major = :major, groupN = :groupN WHERE username = '{$username}'";
                $updateUser = $connection()->prepare($sql);
                $updateUser->execute($data);   
                return ["success" => true];
            } catch (PDOException $e) {
                echo "exception test";
                $this->database->getConnection()->rollBack();
                return ["success" => false, "error" => "Connection failed: " . $e->getMessage()];
            }
        }

     function updateUser($user)
        {
            $this->validate($user->password, $user->email, $user->firstName, $user->lastName);
            $query = $this->userRepository->updateUserQuery([
                "password" => $user->password,
                "firstName" => $user->firstName,
                "lastName" => $user->lastName,
                "email" => $user->email
            ]);
        }
   
   
try {
    $userService->updateUser($user);
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage(),
    ], JSON_UNESCAPED_UNICODE);
    exit();
}

echo json_encode([
    'success' => true,
    'message' => "Информацията е обновена успешно!",
], JSON_UNESCAPED_UNICODE);
