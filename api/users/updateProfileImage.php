<?php
include_once $_SERVER['DOCUMENT_ROOT']."/config/connection.php";
include_once $_SERVER['DOCUMENT_ROOT']."/models/users.php";

$User = new User($db);
$User->user_id = $_SESSION['user']["user_id"];
if (isset($_FILES["profile_image_change"]["name"]) && $_FILES["profile_image_change"]["name"] != "")
{
    if ($_SESSION['user']['profile_image'] !== "media/default/icons8-user.png")
    unlink("../../".$_SESSION['user']['profile_image']);

    $target_dir = "media/users/";
    $imageName = basename($_FILES["profile_image_change"]["name"]);
    $tempname = $_FILES["profile_image_change"]["tmp_name"];
    $ext = pathinfo($imageName, PATHINFO_EXTENSION);
    
    move_uploaded_file($tempname, $_SERVER['DOCUMENT_ROOT']."/".$target_dir.$imageName);
    rename($_SERVER['DOCUMENT_ROOT'].'/media/users/'.$imageName, $_SERVER['DOCUMENT_ROOT'].'/media/users/'.$_SESSION['user']["username"].'.'.$ext);
    $User->profile_image = $target_dir.$_SESSION['user']["username"].'.'.$ext;
    $_SESSION['user']['profile_image'] = $User->profile_image;
    $User->updateProfileImage();
}

header("Location: ../../pages/profilePage.php");
exit();
?>