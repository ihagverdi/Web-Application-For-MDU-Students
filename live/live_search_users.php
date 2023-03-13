<?php
    include_once $_SERVER['DOCUMENT_ROOT']."/config/connection.php";
    include_once $_SERVER['DOCUMENT_ROOT']."/models/users.php";
    session_start();
    $search_username = $_POST['username'];
    $User = new User($db);
    $User->username = $search_username;
    $result = $User->get_similar();
    if($result->rowCount() !== 0){
        $users = array();
        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            if ($_SESSION["user"]["username"] != $username){
            $user = array(
                'username' => $username,
                'profile_image' => $profile_image
            );
            array_push($users,$user);
        }
    }
        echo json_encode($users);
    }
    else{
        echo json_encode(NULL);
    }
   
?>