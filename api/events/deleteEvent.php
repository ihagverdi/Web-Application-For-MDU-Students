<?php
include_once $_SERVER['DOCUMENT_ROOT']."/config/connection.php";
include_once $_SERVER['DOCUMENT_ROOT']."/models/events.php";
$event = new Event($db);
$event->title= $_POST["searchTitle"];
if($event->delete())
{
    unlink($_SERVER['DOCUMENT_ROOT']."/".$event->image);
    header("Location: ../../pages/admin.php");
    exit();
}
?>