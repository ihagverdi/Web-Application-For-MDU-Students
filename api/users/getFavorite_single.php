<?php
include_once $_SERVER['DOCUMENT_ROOT']."/config/connection.php";
include_once $_SERVER['DOCUMENT_ROOT']."/models/users.php";

$database = new Database();
$db = $database->connect();

$User = new User($db);

$User->user_id = $_REQUEST['user_id'];
$User->event_id = $_REQUEST['event_id'];
$result = $User->check_favorite();

echo $result;
?>