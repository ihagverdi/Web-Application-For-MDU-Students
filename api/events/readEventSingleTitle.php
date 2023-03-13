<?php
include_once $_SERVER['DOCUMENT_ROOT']."/config/connection.php";
include_once $_SERVER['DOCUMENT_ROOT']."/models/events.php";
$Event = new Event($db);
$Event->title = $_POST["searchTitle"];
$Event->readSingleTitle();
$event_item = array(
    'event_id' => $Event->event_id,
    'title' => $Event->title,
    'body' => $Event->body,  
    'image' => $Event->image,
    'created_at' => $Event->created_at,
    'event_date' => $Event->event_date,
    'num_tickets' => $Event->num_tickets,
    'category' => $Event->category);

?>