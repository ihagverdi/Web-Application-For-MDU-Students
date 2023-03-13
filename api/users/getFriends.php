<?php
include_once $_SERVER['DOCUMENT_ROOT']."/config/connection.php";
include_once $_SERVER['DOCUMENT_ROOT']."/models/users.php";
$user = new User($db);
$user->user_id = $_SESSION["user"]["user_id"];
$result = $user->get_friends();
$num = $result->rowCount();
if ($num > 0) {
    $friends_arr = array();
    while($row = $result->fetch(PDO::FETCH_ASSOC))
    {
        extract($row);
        $friend = array(
          'friend_id' => $friend_id,
          'profile_image' => $profile_image,
          'username' => $username
        );
        array_push($friends_arr,$friend);
    }
}
else{
    $friends_arr = NULL;
}
?>