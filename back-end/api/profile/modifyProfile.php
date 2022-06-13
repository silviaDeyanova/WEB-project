<?php

$phpInput = json_decode(file_get_contents('php://input'), true);
    header('Content-Type: application/json');

    $password = $phpInput['password'];
    $firstName = $phpInput['firstName'];
    $lastName = $phpInput['lastName'];
    $email = $phpInput['email'];

   
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