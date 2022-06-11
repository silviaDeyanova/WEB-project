<?php
$dbConnection;

function initDB(&$hasErrors) {
    $dbHost = "localhost";
    $dbName = "alumni";
    $dbUser = "root";
    $dbPassword = "";

    global $dbConnection;

    try {
        $dbConnection = new PDO("mysql:dbHost=$dbHost;dbname=$dbName;charset=utf8", $dbUser, $dbPassword);
    } catch (PDOException $e) {
        $hasErrors = true;
        throw new Exception('Connection to database failed: ' . $e->getMessage());
    }
}

function registerUser($topic_name, $topic_subject, $topic_by) {
    global $dbConnection;

    $stmt = $dbConnection->prepare("INSERT INTO topics (topic_name, topic_subjec, topic_by) VALUES (:topic_name, :topic_subject, :topic_by)");
    try {
        $stmt->execute([$topic_name, $topic_subject, $topic_by]);
    }
    catch(Exception $e) {
        if($stmt->errorInfo()[1] == 1062)
        {
            throw new Exception('Грешка се почви при регистрация');
        }
    }
    
}
?>


