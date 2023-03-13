<?php
    include_once $_SERVER['DOCUMENT_ROOT']."/config/connection.php";
    include_once $_SERVER['DOCUMENT_ROOT']."/models/users.php";
    session_start();
    if(isset($_POST['send-request-btn'])){
        $User = new User($db);
        $User->user_id = $_SESSION['user']['user_id'];
        $User->username = $_POST['username'];
        if(!$User->checkFriend()){
            $SenderUser = new User($db);
            $RecieverUser = new User($db);
            $user_id = $_SESSION['user']['user_id'];
            $recieverUsername = $_POST['username'];
            $RecieverUser->username = $recieverUsername;
            if ($RecieverUser->get_user())
            {
                $SenderUser->user_id = $user_id;
                $SenderUser->receiver_id = $RecieverUser->user_id;
        
                if($SenderUser->addRequest()){
                    header("Location: ../../pages/profilePage.php");
                    exit();
                }
            }
            else{
                header('Location: ../../pages/profilePage.php');
                exit();
                }
        }
        else{
            header('Location: ../../pages/profilePage.php');
            exit();
        }
    }
   else{
    return;
   }


?>