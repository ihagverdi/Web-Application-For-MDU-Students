<?php
    session_start();
    if(isset($_POST['password-change-btn'])){
        $oldpass = $_POST["old-password"];
        $newpass_1 = $_POST["new-password-1"];
        $newpass_2 = $_POST["new-password-2"];
        if($newpass_1 === $newpass_2){
            if($oldpass !== $newpass_1){
                include_once $_SERVER['DOCUMENT_ROOT']."/config/connection.php";
                include_once $_SERVER['DOCUMENT_ROOT']."/models/users.php";
                $User = new User($db);
                $User->user_id = $_SESSION['user']['user_id'];
                $User->checkPass();
                if(password_verify($oldpass,$User->password)){
                    $User->password = password_hash($newpass_1, PASSWORD_BCRYPT);
                    $result = $User->changePass();
                }
                
            }
        }
    }
    header('Location: ../../pages/profilePage.php');
    exit(); 
?>