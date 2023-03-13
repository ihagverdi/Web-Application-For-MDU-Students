<?php
include_once $_SERVER['DOCUMENT_ROOT']."/config/connection.php";
include_once $_SERVER['DOCUMENT_ROOT']."/models/users.php";
$user = new User($db);

$user->user_id = $_REQUEST["friend_id"];
$result = $user->get_favorites();
$num = $result->rowCount();
$friendFavorites_arr = array();
if ($num > 0) {
    $friendFavorites_arr = array();
    while($row = $result->fetch(PDO::FETCH_ASSOC))
    {
        extract($row);
        $event = array(
            'event_id' => $event_id,
            'title' => $title,
            'body' => $body,  
            'image' => $image,
            'created_at' => $created_at,
            'event_date' => $event_date,
            'num_tickets' => $num_tickets,
            'reserved_tickets' => $reserved_tickets,
            'category' => $category
        );
        array_push($friendFavorites_arr, $event);
    }

}
else{
    $friendFavorites_arr = null;
}
?>