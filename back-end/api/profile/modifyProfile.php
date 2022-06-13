<?php
require_once("../../db/connection/connect.php");

$phpInput = json_decode(file_get_contents('php://input'), true);
header('Content-Type: application/json');

    $username = $phpInput['username'];
    $password = $phpInput['password'];
    $fn = $phpInput['fn'];
    $email = $phpInput['email'];
    $graduation = $phpInput['graduation'];
    $major = $phpInput['major'];
    $groupN = $phpInput['groupN'];

    public function updateUserQuery($data)
        {
            $this->database->getConnection()->beginTransaction();   
            try {
                $sql = "UPDATE users SET password = :password, firstName = :firstName, 
                        lastName = :lastName, email = :email WHERE id = '{$_SESSION['userId']}'";
                $this->updateUser = $this->database->getConnection()->prepare($sql);
                $this->updateUser->execute($data);
                $this->database->getConnection()->commit();   
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
