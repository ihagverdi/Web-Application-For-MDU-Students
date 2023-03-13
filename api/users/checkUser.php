<?php
include_once $_SERVER['DOCUMENT_ROOT']."/config/connection.php";
include_once $_SERVER['DOCUMENT_ROOT']."/models/users.php";
if (isset($_POST["submit"]))
    {
        $User = new User($db);
        $User->username = $_REQUEST["username"];
        $secret = "6LfCmsMiAAAAAKo8AiZuh12PE5Kx6me7RSnIEJvv";
        $response = $_POST["g-recaptcha-response"];
        // $remoteip = $_SERVER['REMOTE_ADDR'];
        $URL = "https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$response";
        $data = json_decode(file_get_contents($URL), true);


        if ($data["success"] == true) 
        {
            if ($User->checkUser())
            {
                if (!password_verify($_REQUEST["password"], $User->password)) {
                    echo "<script>alert('Wrong Password!');
                    window.location.href = 'http://localhost:3000/pages/login.php'</script>";
                    exit();
                }
                if ($User->is_admin == 0){
                    header('Location: ../../pages/index.php');
                }
                else {
                    header('Location: ../../pages/admin.php');
                }

                include "../../sessions/set_session.php";
                exit();
            }
            else{
                echo "<script>alert('Wrong Username!');
                window.location.href = 'http://localhost:3000/pages/login.php'</script>";
                exit();
            }
    }
    else {
        header('Location: ../../pages/login.php');
        exit();
    }
}

?>