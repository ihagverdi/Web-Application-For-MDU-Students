<?php
include_once $_SERVER['DOCUMENT_ROOT']."/config/connection.php";
include_once $_SERVER['DOCUMENT_ROOT']."/models/users.php";
session_start();
$User = new User($db);
$User->user_id = $_SESSION['user']['user_id'];
$User->friend_id = $_REQUEST['friend_id'];
if($User->remove_friend())
{
    header('Location: http://'.  $_SERVER['HTTP_HOST'] . '/pages/profilePage.php');
    exit();
}
?>