<?php
include_once $_SERVER['DOCUMENT_ROOT']."/config/connection.php";
include_once $_SERVER['DOCUMENT_ROOT']."/models/users.php";
$User = new User($db);

$user_id = $_SESSION['user_id'];
$friend_id= $_REQUEST['friend_id'];

$User->user_id = $user_id;
$User->friend_id = $friend_id;

$User->add_friend();
?>