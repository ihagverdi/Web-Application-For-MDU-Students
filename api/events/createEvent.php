<?php
    include_once $_SERVER['DOCUMENT_ROOT']."/config/connection.php";
    include_once $_SERVER['DOCUMENT_ROOT']."/models/events.php";
    $Event = new Event($db);
    $title = $_POST['title'];
    $body= $_POST['body'];
    $event_date= $_POST['event_date'];
    $category= $_POST['category'];
    $num_tickets = $_POST['num_tickets'];

    $target_dir = "media/events/";
    $imageName = basename($_FILES["image"]["name"]);
    $tempname = $_FILES["image"]["tmp_name"];
    $ext = pathinfo($imageName, PATHINFO_EXTENSION);
    move_uploaded_file($tempname, $_SERVER['DOCUMENT_ROOT']."/".$target_dir.$imageName);
    rename($_SERVER['DOCUMENT_ROOT'] .'/media/events/'.$imageName, $_SERVER['DOCUMENT_ROOT'].'/media/events/'.$title.'.'.$ext);
    $Event->title = $title;
    $Event->body = $body;
    $Event->image = $target_dir.$title.'.'.$ext;
    
    $Event->event_date = $event_date;
    $Event->category = $category;
    $Event->num_tickets = $num_tickets;
    if($Event->create()){
        header("Location: ../../pages/admin.php");
        exit();
    }

?>