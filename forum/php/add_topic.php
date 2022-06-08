<?php 

require_once("../../back_end/db/connection/connect.php");


// php://input is a readonly stream which allows us to read raw data from the request body - it returnes all the raw data after the HTTP headers of the request no matter the content type
// file_get_contents() reads file into a string, but in this case it parses the raw data from the stream into the string
$data = file_get_contents("php://input");

$user_data = null; // used to store the decoded JSON string $data

// check if the JSON is correct
if (strlen($data) > 0 && check_json($data)) {
    $user_data = json_decode($data, true);
}
else {
    http_response_code(400);
    exit(json_encode(["status" => "ERROR", "message" => "Невалиден JSON формат!"]));
}

$topic = $user_data["topic"]; // get input topic
$topic_info = $user_data["topic_info"]; // get topic info
$topic_date=date("h:i:sa");
$topic_by = $connection->lastInsertId();


try {
    $insert = "INSERT INTO topics (topic_name, topic_subject, topic_date, topic_by)
                      VALUES (:topic, :lastname, :topic_info, :topic_date,:topic_by)";

    $stmt = $connection->prepare($insert);
    
} catch (PDOException $e) {
    http_response_code(500);
    exit(json_encode(["status" => "ERROR", "message" => "Неочаквана грешка настъпи в сървъра!"]));
}

?>