<?php
    include_once $_SERVER['DOCUMENT_ROOT']."/config/connection.php";
    include_once $_SERVER['DOCUMENT_ROOT']."/models/users.php";
    $user = new User($db);
    $user->username = $_REQUEST['friend_username'];
    if ($user->get_user()) {
        $friend = array(
            'user_id' => $user->user_id,
            'profile_image' => $user->profile_image,
            'username' => $user->username);
        
        
    }
?>