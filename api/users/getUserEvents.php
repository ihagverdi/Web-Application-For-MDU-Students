<?php
    include_once $_SERVER['DOCUMENT_ROOT']."/config/connection.php";
    include_once $_SERVER['DOCUMENT_ROOT']."/models/users.php";
    $User_events_obj = new User($db);
    $User_events_obj->user_id = $_SESSION['user']['user_id'];
    $result_events = $User_events_obj->get_user_events();
    if ($result_events->rowCount() > 0) {
        $events_arr = array();
        while($row_events = $result_events->fetch(PDO::FETCH_ASSOC))
        {
            extract($row_events);
            $event = array(
                'event_id' => $event_id,
                'title' => $title,
                'body' => $body,  
                'image' => $image,
                'created_at' => $created_at,
                'event_date' => $event_date,
                'num_tickets' => $num_tickets,
                'reserved_tickets' => $reserved_tickets,
                'category' => $category);
            array_push($events_arr, $event);
        }
    }
    else {
        return;
    }
?>