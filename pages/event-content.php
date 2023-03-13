<?php
session_start();
$user_id = $_SESSION['user']['user_id']; 
$event_id = $_REQUEST['event_id'];
if(!isset($_SESSION['user'])){
  header("Location: login.php");
  exit();
}
include_once "../api/events/readEvent_single.php";
include_once "../api/users/check_favorite.php";
include_once "../api/users/check_reservation.php";
    
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://fonts.googleapis.com/css?family=Source+Sans+Pro"
      rel="stylesheet"
      type="text/css"
    />
    <link rel="stylesheet" href="/style/event-content.css" />
    <title>Event Club</title>
  </head>
  <body class="body-container">
  <header class="header-container">
    <a  id="logo" href="index.php"><img src="/media/MDU.svg" /></a>
    <div id = "search-bar">
      <input onkeyup = "search(this.value)" id="search-input" type="search" placeholder="Search..."/>
      <ul id="suggestions-list"></ul>
    </div>
      
      <div class="icons">
      <?php if($_SESSION['user']['is_admin'] == 1){?>
        <a id = "admin-link" href = "admin.php">Admin</a>
        <?php } else {?>
          <a href = "profilePage.php"><img class = "profile-image" src = "<?="../".$_SESSION['user']['profile_image']?>"</a>
          <?php } ?>
        <a href="../sessions/destroy_session.php" id="logout-btn">Logout</a>

      </div>
      
    </header>
    <main class="main-container">

      <div class="content-wrapper">

        <div  class="event-img">
          <img id = "event-image" src= "<?="../".$event_item['image']?>" alt="">
        </div>

        <div class="content">

          <div class = "main-info-1">
            <h1 id = "title"><?php echo $event_item['title']; ?></h1>
            <h4 id = "created_at"><?php echo date("Y/m/d",strtotime($event_item['created_at']));?></h4>
          </div>

          <div class = "details">

            <div class="description">
              <article>
                <?php echo $event_item['body']; ?>
              </article>
            </div>

            <div class = "main-info-2">
              <div id = "category"><h4>Category: </h4><?php echo $event_item['category']; ?></div>
              <div id = "event-date"><h4>Event Date: </h4><?php echo  date("D, d M, Y h:i A",strtotime($event_item['event_date']))?></div>
              <div id = "num-tickets"><h4>Seats Number: </h4><?php echo $event_item['num_tickets']; ?></div>

              <div class="emojis">
                <?php include "../config/eventInteractions.php";?>
              </div>  
              
            </div>
          </div>
        </div>
      </div>
    </main>
    <script src = "../script/catalog-events.js"></script>
    <script src = "../script/live-search.js"></script>
  </body>




        


          


  