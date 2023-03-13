<?php
    if(isset($_POST['delete-account-btn'])){
        include_once $_SERVER['DOCUMENT_ROOT']."/config/connection.php";
        include_once $_SERVER['DOCUMENT_ROOT']."/models/users.php";
        $User_delete_obj = new User($db);
        $User_delete_obj->user_id = $_POST['user-id-delete'];
        $User_delete_obj->delete_user();
        include "../../sessions/destroy_session.php";
        
    }
    else{
        return;
    }
?>