<?php
include_once $_SERVER['DOCUMENT_ROOT']."/config/connection.php";
include_once $_SERVER['DOCUMENT_ROOT']."/models/events.php";
$event = new Event($db);
$event->event_id = $_REQUEST["event_id"];
$event->readSingle();
$event_item = array(
    'event_id' => $event->event_id,
    'title' => $event->title,
    'body' => $event->body,  
    'image' => $event->image,
    'created_at' => $event->created_at,
    'event_date' => $event->event_date,
    'num_tickets' => $event->num_tickets,
    'reserved_tickets' => $event->reserved_tickets,
    'category' => $event->category);

?>