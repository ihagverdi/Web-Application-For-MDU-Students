<?php
// session_start();
include_once $_SERVER['DOCUMENT_ROOT']."/config/connection.php";
include_once $_SERVER['DOCUMENT_ROOT']."/models/events.php";
$Event = new Event($db);
$string = "all";

if (isset($_POST["category"])){
    
  $category_arr = $_POST['category'];
  $len = count($category_arr);
  $string = "";
  for($i = 0; $i < $len; $i++){
      if($i == $len-1){
        $string .= "'".$category_arr[$i] ."'";
      }
      else{
        $string .= "'".$category_arr[$i] ."'" . ",";
      }
  
    }
}
if($_SESSION['user']['is_admin'] == 0){
  if(isset($_POST['from']) && $_POST['from'] < date('Y-m-d H:i:s')){
    $_POST['from'] = date('Y-m-d H:i:s');
  }
}
if((!isset($_POST['from']) || $_POST['from'] == "") && (isset($_POST['to']) && $_POST['to'] != "")){
    
    $date_to = date('Y-m-d 23:59:59', strtotime($_POST['to']));
    $result = $Event->read($string, $date_to, date('Y-m-d H:i:s'));
}
else if(!isset($_POST['to']) || $_POST['to'] == ""){
  if (isset($_POST['from']) && $_POST['from'] != "")
  {
    $date_from = $_POST['from'];
    $result = $Event->read($string, false,  $date_from);
  }
  else {
    $result = $Event->read($string, false, date('Y-m-d H:i:s'));
  }
  
}
else if(isset($_POST['from']) && isset($_POST['to'])){
  if ($_POST['from'] != "" && $_POST['to'] != "")
  {
    $date_from =  $_POST['from'];
    $date_to = date('Y-m-d 23:59:59', strtotime($_POST['to']));
    $result = $Event->read($string, $date_to, $date_from);
  }
  else {
    $result = $Event->read($string, false, date('Y-m-d H:i:s'));
  }
}


$num = $result->rowCount();
$events_arr = NULL;
if ($num > 0) {
    $events_arr = array();
    while($row = $result->fetch(PDO::FETCH_ASSOC))
    {
        extract($row);
        $event_item = array(
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
        array_push($events_arr,$event_item);
    }   
}
?>