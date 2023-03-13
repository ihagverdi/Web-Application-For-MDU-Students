<?php
  session_start();
  if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit();
  }
  include('../api/events/readEvent.php');
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
    <link rel="stylesheet" href="/style/index.css" />
    <title>Event Club</title>
  </head>
  <body class="body-container">
    <header class="header-container">
    <a  id="logo" href="index.php"><img src="/media/MDU.svg" /></a>
    <div id = "search-bar">
      <input onkeyup = "search(this.value)" id="search-input" type="search" placeholder="Search..."/>
      <ul id="suggestions-list"></ul>
    </div>
    <div class="dropDown-filter-box">
          <?php
            $category = ['trips', 'parties', 'sports', 'seminars', 'arts & culture', 'fikas'];
          ?>
          <form class = "filters dropDown-filters" action="index.php" method = "POST">
            <h3 id = "dropDown-btn">Filters</h3>
            <?php for ($i = 0; $i < count($category); $i++) {?>
              <div id = "category-filters-<?=$category[$i]?>" class="category-filters">
            <input type="checkbox" name="category[]" id="<?= $category[$i];?>" value = "<?= $category[$i];?>"
            <?php if (isset($_POST['category'])) {
                       $checkedArray = $_POST['category'];

                          if (in_array($category[$i], $checkedArray))
                          echo "checked";
                        

                   }?>
            />
            <label for = "<?= $category[$i]?>" ><?= $category[$i];?></label>
              </div>
          <?php }?>
          <div id = "dates" class="dates">
            <label for = "from" >From: </label>
            <input class = "date-picker" type="date" name="from" id="from"/>
            <br>
            <label for = "to" >To: </label>
            <br>
            <input class = "date-picker" type="date" name="to" id="to"/>
            <br>
            <button type="submit" id ="filter-submit">Submit</button>
          </div>
          
          </form>
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
        <!-- SIDE BAR -->
        <div class="side-bar">
          <?php
            $category = ['trips', 'parties', 'sports', 'seminars', 'arts & culture', 'fikas'];
          ?>
          <form class = "filters" action="index.php" method = "POST">
            <?php for ($i = 0; $i < count($category); $i++) {?>
              <div class="category-filters">
            <input type="checkbox" name="category[]" id="<?= $category[$i];?>" value = "<?= $category[$i];?>"
            <?php if (isset($_POST['category'])) {
                       $checkedArray = $_POST['category'];

                          if (in_array($category[$i], $checkedArray))
                          echo "checked";
                        

                   }?>
            />
            <label><?= $category[$i];?></label>
              </div>
          <?php }?>
          <div class="dates">
            <label for = "from" >From: </label>
            <input class = "date-picker" type="date" name="from" id="from"/>
            <br>
            <label for = "to" >To: </label>
            <br>
            <input class = "date-picker" type="date" name="to" id="to"/>
            <br>
            <button type="submit" id ="filter-submit">Submit</button>
          </div>
          
          </form>
        </div>
          <!-- ALL EVENTS -->
        <div class = "main-content">
          <div class="wrapper">

            <div class="slideshow">
              <a id="landscape-link" ><img id = 'landscape-img'/></a>
              <h2 id="landscape-title"></h2>
            </div>

            <div class = "events">
              <?php  if(isset($events_arr)){ 
                foreach($events_arr as $event){
                  $event_id = $event['event_id'];
                  $event_date = $event['event_date'];
                  $title = $event['title'];
                  $image = "../".$event['image'];
                  $reserved_tickets = $event['reserved_tickets'];
                  $num_tickets = $event['num_tickets'];
                  $available_tickets = $num_tickets - $reserved_tickets;
                 
                  include "../api/users/check_favorite.php";
                  include "../api/users/check_reservation.php";
                  
                ?>
              <div  class = "event-item">
                  <div class="event-item-image">
                    <a href = <?php echo "event-content.php?event_id=" .$event_id?>>
                    <img class = "event-img" src = '<?=$image?>' ?>/>
                    </a>
                  </div>

                  <div class = "event-item-details">
                    <h4 class = "event-item-date"><?=date("F j",strtotime($event_date))?></h4>
                    <h3 class = "event-item-title"><?=$title?></h3>
                  </div>

                  <div class = "event-item-emojis">
                      <!-- Check if the dynamically created event is reserved -->
                      
                       <?php 
                          if($is_reserved){ ?>
                            <img  class = "ticket-icon" src = '/media/icons8-ticket.png' onclick = <?php echo "reservationChecker(this,".$event_id. ",". $_SESSION['user']['user_id']. ")";?>>
                        <?php } else {
                              if ($num_tickets != $reserved_tickets)
                              {?>
                          <img  class = "ticket-icon" src = '/media/icons8-ticket-blank.png' onclick = <?php echo "reservationChecker(this,".$event_id. ",". $_SESSION['user']['user_id'].")";?> >
                        <?php }
                        else {?>
                            <img class = "ticket-icon" src = '/media/icons8-x-50.png'/>
                        <?php }}?>
                      <div class="seats">
                      <h2 id = "num-seats-<?=$event_id?>" class = "value"> <?php echo $available_tickets;?> </h2>
                        <h3 class = "tickets">Seats left</h3>
                      </div>
                      <!-- Check if the dynamically created event is a favorite -->
                      
                        
                      <?php if($is_favorite){ ?>
                        <img  class = "favorite-icon" src = '/media/icons8-heart-filled.png' onclick = <?php echo "favoriteChecker(this,".$event_id. ",". $_SESSION['user']['user_id'].")";?>>
                      <?php } else {?>
                        <img  class = "favorite-icon" src = '/media/icons8-heart-blank.png' onclick = <?php echo "favoriteChecker(this,".$event_id. ",".$_SESSION['user']['user_id'].")";?>>
                      <?php } ?>
                  </div>

                </div>
 <?php } }?>
              </div>
           
          </div>

        </div>
      </div>
    </main>
    <script src = "../script/dropDown.js"></script>
    <script src = "../script/live-search.js"></script>
    <script src = "../script/slideShow.js"></script>
    <script src = "../script/catalog-events.js"></script>
  </body>
</html>
