<?php
  session_start();
  $_SESSION['user']['username'] = $User->username;
  $_SESSION['user']['user_id'] = $User->user_id;
  $_SESSION['user']['is_admin'] = $User->is_admin;
  $_SESSION['user']['email'] = $User->email;
  $_SESSION['user']['profile_image'] = $User->profile_image;
  ?>