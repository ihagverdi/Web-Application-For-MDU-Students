<?php
include_once $_SERVER['DOCUMENT_ROOT']."/config/connection.php";
include_once $_SERVER['DOCUMENT_ROOT']."/models/users.php";
$User = new User($db);
$sender_id = $_REQUEST["sender_id"];
$receiver_id = $_REQUEST['receiver_id'];
$User->user_id = $sender_id;
$User->receiver_id = $receiver_id;

$User->friend_id = $receiver_id;

if ($User->removeRequest() && $User->add_friend())
{
    header('Location: ../../pages/profilePage.php');
    exit();
}


?>