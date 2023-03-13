<?php
include_once $_SERVER['DOCUMENT_ROOT']."/config/connection.php";
include_once $_SERVER['DOCUMENT_ROOT']."/models/users.php";
$User = new User($db);
$User->user_id = $_SESSION['user']['user_id'];
$User->event_id = $event_id;
$is_favorite = $User->check_favorite();

?>