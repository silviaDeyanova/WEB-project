<?php

$phpInput = json_decode(file_get_contents('php://input'), true);
header('Content-Type: application/json');

$firstName = $phpInput['username'];
$password = $phpInput['password'];
$fn = $phpInput['fn'];
$email = $phpInput['email'];
$graduation = $phpInput['graduation'];
$major = $phpInput['major'];
$groupN = $phpInput['groupN'];

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
