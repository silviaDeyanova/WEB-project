<?php
require_once('../backend/db/connection/connect.php');

$db = new DB();
    $connection = $db->getConnection();

    session_start();
    echo $_SESSION["username"]
    
?>