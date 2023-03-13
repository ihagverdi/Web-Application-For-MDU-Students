<?php
    session_start();
    if(isset($_POST["update-settings-btn"])){
        if(isset($_POST["new-username"])){
        $new_username = $_POST['new-username'];
        if($new_username != $_SESSION['user']['username']){
            include_once $_SERVER['DOCUMENT_ROOT']."/config/connection.php";
            include_once $_SERVER['DOCUMENT_ROOT']."/models/users.php";
            $User = new User($db);
            $User->user_id = $_SESSION['user']['user_id'];
            $User->username = $new_username;
            $result = $User->change_username();
            if($result){
                $_SESSION['user']['username'] =  $User->username;
            }
        }
    }
    include "updateProfileImage.php";
}


?>