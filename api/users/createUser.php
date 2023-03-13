<?php
include_once $_SERVER['DOCUMENT_ROOT']."/config/connection.php";
include_once $_SERVER['DOCUMENT_ROOT']."/models/users.php";
$User = new User($db);
$User0 = new User($db);
$username = $_POST['username'];
$email= $_POST['email'];
$password = $_POST["password"];
$repassword = $_POST["repassword"];

if (strpos($email, "@student.mdu.se")) {
    if ($password !== $repassword) {
        echo "<script>alert('Passwords are not matched!');
        window.location.href = 'http://localhost:3000/pages/sign-up.php'</script>";
        exit();
    }
    else {
    $User->username = $username;
    $User->email = $email;
    $User->profile_image = "media/default/icons8-user.png";
    
    $User0->username = $username;
    $User0->email = $email;
    $User->password = password_hash($password, PASSWORD_BCRYPT);
    if($User0->checkUser())
    {
        echo "<script>alert('Username or Email already used!');
        window.location.href = 'http://localhost:3000/pages/sign-up.php'</script>";
        exit();
    }
    $User->create();
    if ($User->get_user()) {
        
        include "../../sessions/set_session.php";
    }
}
    
}

else {
    header('Location: ../../pages/sign-up.php');
    exit();
}

header('Location: ../../pages/index.php');
exit();
?>