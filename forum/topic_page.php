<?php
require_once '../back-end/db/connection/handler.php' ;
    if($_POST)
    {
        $topic_name = $_POST['topic_name'];
        $topic_subject = $_POST['topic_subject'];
        $topic_by=$_POST['topic_by'];

        create($topic_name, $topic_subject, $topic_by);
        
        /*$errors = validate_registration_form($fn, $nickname, $email, $password, $password_again);
        if(!$errors)
        {
            create($topic_name, $topic_subject, $topic_by);
        }
        foreach($errors as $e)
        {
            echo $e . "<br>";
        }*/

    }

    function create($topic_name, $topic_subject, $topic_by)
    {
        try
        {
            registerUser($topic_name, $topic_subject, $topic_by);
            echo "Регистрацията е направена успешно! Може да влезете в профила си.<br>";
        }
        catch(Exception $e)
        {
            echo "Съществува потребител с такъв факултетен номер, потребителско име или парола.<br>";
        }
    }
?>
