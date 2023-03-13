<?php
  session_start();
  $user_id = $_SESSION['user']['user_id'];
  if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit();
  }
  include "../api/users/getFriend.php";
  include "../api/users/getFriendReservations.php";
  include "../api/users/getFriendFavorites.php";
?>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport" />
  <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
  <link rel="stylesheet" href="../style/profilePage.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous" />

  <title>Profile Page</title>
</head>

<body>
  <header class="header-container">
    <a href="index.php">
      <img class="header-items" id="logo" src="/media/MDU.svg" />
    </a>

    <a href="../sessions/destroy_session.php" class="logout">
      <button class="btn event" style="color: white">Logout</button></a>
  </header>
  <section class="my-3">
    <div class="container">
      <!-- <h1 class="mb-5">Account Settings</h1> -->
      <div class="bg-white shadow rounded-lg d-block d-sm-flex">
        <div class="profile-tab-nav border-right">
          <div class="p-4">
            <div class="img-circle text-center mb-3 TheDive">
              <img src="<?= "../" . $friend["profile_image"] ?>" alt="Image" class="shadow bloreImage" />
            </div>
            <h4 class="text-center"><?= $friend["username"] ?></h4>
          </div>
          <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">

            <a class="nav-link active" id="favorites-tab" data-toggle="pill" href="#favorites" role="tab" aria-controls="favorites" aria-selected="true">
              <i class="fa fa-star"></i>
              Favorites
            </a>
            <a class="nav-link" id="application-tab" data-toggle="pill" href="#reservation" role="tab" aria-controls="application" aria-selected="false">
              <i class="fa fa-ticket"></i>
              Reservations
            </a>
          </div>
        </div>
        <div class="tab-content p-4 p-md-5" id="v-pills-tabContent">

          <!-- favorites -->
          <div class="tab-pane fade show active" id="favorites" role="tabpanel" aria-labelledby="favorites-tab">
            <h3 class="mb-4">Favorites</h3>
            <div class="row">

              <?php
              if (isset($friendFavorites_arr)) {

                foreach ($friendFavorites_arr as $user_favorite) {
                  $event_id = $user_favorite['event_id'];
                  include "../api/users/check_favorite.php";
                  include "../api/users/check_reservation.php";

              ?>
                  <div class="card card-decoration col-md-4 cardSettings">
                    <img class="card-img-top card-image" src="<?= "../" . $user_favorite['image'] ?>" alt="favorite event" />
                    <div class="card-body">
                      <h5 class="card-title"><?php echo $user_favorite['title'] ?></h5>
                      <div class="downbuttons">
                        <div class="theRow">
                          <div class="item-1">
                            <a href="event-content.php?event_id=<?= $user_favorite['event_id'] ?>" class="btn event" style="color: white">Browse</a>
                          </div>
                          <div class="item-2 icons">
                          <?php
                              if($is_reserved){ ?>
                                <img  class = "ticket-icon" src = '/media/icons8-ticket.png' onclick = <?php echo "reservationChecker(this,".$event_id. ",". $_SESSION['user']['user_id']. ")";?>>
                            <?php } else {
                                  if ($user_favorite['num_tickets'] != $user_favorite['reserved_tickets'])
                                  {?>
                              <img  class = "ticket-icon" src = '/media/icons8-ticket-blank.png' onclick = <?php echo "reservationChecker(this,".$event_id. ",". $_SESSION['user']['user_id'].")";?> >
                            <?php }
                            else {?>
                                <img class = "ticket-icon" src = '/media/icons8-x-50.png'/>
                            <?php }}?>
                            <?php if($is_favorite){ ?>
                                <img  class = "favorite-icon" src = '/media/icons8-heart-filled.png' onclick = <?php echo "favoriteChecker(this,".$event_id. ",". $_SESSION['user']['user_id'].")";?>>
                                <?php } else {?>
                                <img  class = "favorite-icon" src = '/media/icons8-heart-blank.png' onclick = <?php echo "favoriteChecker(this,".$event_id. ",". $_SESSION['user']['user_id'].")";?>>
                                <?php } ?>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
              <?php }
              } ?>
            </div>
          </div>
          <!-- Reservation -->
          <div class="tab-pane fade" id="reservation" role="tabpanel" aria-labelledby="reservation-tab">
            <h3 class="mb-4">Reservations</h3>
            <div class="row">
              <?php
              if (isset($friendReservations_arr)) {

                foreach ($friendReservations_arr as $user_reservation) {
                  $event_id = $user_reservation['event_id'];
                  include "../api/users/check_favorite.php";
                  include "../api/users/check_reservation.php";
              ?>
                  <div class="card card-decoration col-md-4 cardSettings">

                    <img class="card-img-top card-image" src="<?= "../" . $user_reservation['image'] ?>" alt="favorite event" />
                    <div class="card-body">
                      <h5 class="card-title"><?php echo $user_reservation['title'] ?></h5>
                      <div class="downbuttons">
                        <div class="theRow">
                          <div class="item-1">
                            <a href="event-content.php?event_id=<?= $user_reservation['event_id'] ?>" class="" style="color: white"><button class="btn event" style="color: white;">Browse</button></a>
                          </div>
                          <div class="item-2 icons">
                          <?php
                              if($is_reserved){ ?>
                                <img  class = "ticket-icon" src = '/media/icons8-ticket.png' onclick = <?php echo "reservationChecker(this,".$event_id. ",". $_SESSION['user']['user_id']. ")";?>>
                            <?php } else {
                                  if ($user_reservation['num_tickets'] != $user_reservation['reserved_tickets'])
                                  {?>
                              <img  class = "ticket-icon" src = '/media/icons8-ticket-blank.png' onclick = <?php echo "reservationChecker(this,".$event_id. ",". $_SESSION['user']['user_id'].")";?> >
                            <?php }
                            else {?>
                                <img class = "ticket-icon" src = '/media/icons8-x-50.png'/>
                            <?php }}?>
                            <?php if($is_favorite){ ?>
                                <img  class = "favorite-icon" src = '/media/icons8-heart-filled.png' onclick = <?php echo "favoriteChecker(this,".$event_id. ",". $_SESSION['user']['user_id'].")";?>>
                                <?php } else {?>
                                <img  class = "favorite-icon" src = '/media/icons8-heart-blank.png' onclick = <?php echo "favoriteChecker(this,".$event_id. ",". $_SESSION['user']['user_id'].")";?>>
                                <?php } ?>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

              <?php }
              } ?>
            </div>

          </div>
        </div>
      </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
  </section>
  <script src="../script/catalog-events.js"></script>
  <script src="../script/live-search-users.js"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>