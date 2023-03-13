<?php
include_once $_SERVER['DOCUMENT_ROOT']."/config/connection.php";
include_once $_SERVER['DOCUMENT_ROOT']."/models/users.php";

$database = new Database();
$db = $database->connect();

$User = new User($db);

$user_id = $_REQUEST['user_id'];
$event_id = $_REQUEST['event_id'];

$User->user_id = $user_id;
$User->event_id = $event_id;

$User->remove_favorite();
?>