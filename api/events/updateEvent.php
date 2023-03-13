<?php
include_once $_SERVER['DOCUMENT_ROOT']."/config/connection.php";
include_once $_SERVER['DOCUMENT_ROOT']."/models/events.php";
$Event = new Event($db);
$Event0 = new Event($db);
$event_id = $_REQUEST['event_id'];
$title = $_POST['title'];

$body= $_POST['body'];

$event_date= $_POST['event_date'];

$category= $_POST['category'];

$num_tickets = $_POST['num_tickets'];

$Event->event_id = $event_id;
$Event->title = $title;
$Event->body = $body;
$Event->event_date = $event_date;
$Event->category = $category;
$Event->num_tickets = $num_tickets;

$Event0->event_id = $event_id;
$Event0->readSingle();
if (isset($_FILES["image"]["name"]) && $_FILES["image"]["name"] != "")
{
    unlink($_SERVER['DOCUMENT_ROOT']."/".$Event0->image);
    $target_dir = "media/events/";
    $imageName = basename($_FILES["image"]["name"]);
    $tempname = $_FILES["image"]["tmp_name"];
    $ext = pathinfo($imageName, PATHINFO_EXTENSION);
    move_uploaded_file($tempname, $_SERVER['DOCUMENT_ROOT']."/" .$target_dir.$imageName);
    rename($_SERVER['DOCUMENT_ROOT'].'/media/events/'.$imageName, $_SERVER['DOCUMENT_ROOT'].'/media/events/'.$title.'.'.$ext);
    $Event->image = $target_dir.$title.'.'.$ext;
}
else {
    $Event->image = $Event0->image;
}

if ($Event->update()) {
    header("Location: ../../pages/admin.php");
    exit();
}

?>