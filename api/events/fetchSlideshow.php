<?php
    include_once $_SERVER['DOCUMENT_ROOT']."/config/connection.php";
    include_once $_SERVER['DOCUMENT_ROOT']."/models/events.php";
    $Event = new Event($db);
    $result = $Event->fetch_slideshow();
    if($result->rowCount() !== 0){
        $slideshow_events = array();
        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $event = array(
                'event_id' => $event_id,
                'title' => $title,
                'body' => $body,  
                'image' => $image,
                'created_at' => $created_at,
                'event_date' => $event_date,
                'num_tickets' => $num_tickets,
                'category' => $category
            );
            array_push($slideshow_events,$event);
        }
        echo json_encode($slideshow_events);
    }
    else{
        return;
    }
?>