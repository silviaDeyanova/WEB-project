<?php

$phpInput = json_decode(file_get_contents('php://input'), true);
    header('Content-Type: application/json');

    $password = $phpInput['password'];
    $firstName = $phpInput['firstName'];
    $lastName = $phpInput['lastName'];
    $email = $phpInput['email'];

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

    public function updateUser($user)
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
        ]);
        exit();
    }

    echo json_encode([
        'success' => true,
        'message' => "The user information is updated successfully.",
    ]);
?>
