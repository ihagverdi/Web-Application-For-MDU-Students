<?php
    include_once $_SERVER['DOCUMENT_ROOT']."/config/connection.php";
    include_once $_SERVER['DOCUMENT_ROOT']."/models/events.php";
  
    $inputString = $_POST['input'];
    if($inputString != ""){
    $Event = new Event($db);
    $result = $Event->get_similar($inputString);
    $events = array();
    if($result->rowCount() != 0){
        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $event = array(
                "event_id" => $event_id,
                "category" => $category,
                "title" => $title,
                "body" => $body,
                "image" => $image,
                "event_date" => $event_date,
                "num_tickets" => $num_tickets,
                "reserved_tickets" => $reserved_tickets
            );
            array_push($events,$event);
        }
    }
}
echo count($events) === 0 ? json_encode(NULL) : json_encode($events);
 
?>