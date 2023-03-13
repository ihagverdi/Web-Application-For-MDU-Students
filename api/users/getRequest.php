<?php
  include_once $_SERVER['DOCUMENT_ROOT']."/config/connection.php";
  include_once $_SERVER['DOCUMENT_ROOT']."/models/users.php";
  $User_request = new User($db);
  $reciever_id = $_SESSION['user']['user_id'];
  $User_request->user_id = $reciever_id;


  $result_request = $User_request->get_requests();
  $num = $result_request->rowCount();
  $requests_arr = NULL;
  if ($num > 0) {
      $requests_arr = array();
      while($row_request = $result_request->fetch(PDO::FETCH_ASSOC))
      {
          extract($row_request);
          $request_person = array(
            'user_id' => $user_id,
            'profile_image' => $profile_image,
            'username' => $username
          );
          array_push($requests_arr, $request_person);
      }   
  }
  else{
    return;
  }
?>

