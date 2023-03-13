<?php
  session_start();
  if($_SESSION['user']['is_admin'] == 1){
    header("Location: index.php");
    exit();
  }
  if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit();
  }
  include "../api/users/getUserEvents.php";
  include "../api/users/getRequest.php";
  include "../api/users/getFriends.php";
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
              <img src="<?= '../' . $_SESSION['user']['profile_image'] ?>" alt="Image" class="shadow bloreImage" />
            </div>
            <h4 class="text-center"><?= $_SESSION['user']['username'] ?></h4>
          </div>
          <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <a class="nav-link active" id="account-tab" data-toggle="pill" href="#account" role="tab" aria-controls="account" aria-selected="true">
              <i class="fa fa-cog"></i>
              Settings
            </a>
            <a class="nav-link" id="password-tab" data-toggle="pill" href="#password" role="tab" aria-controls="password" aria-selected="false">
              <i class="fa fa-key text-center mr-1"></i>
              Password
            </a>
            <a class="nav-link" id="favorites-tab" data-toggle="pill" href="#favorites" role="tab" aria-controls="favorites" aria-selected="false">
              <i class="fa fa-star"></i>
              All Events
            </a>

            <a class="nav-link" id="frinds-tab" data-toggle="pill" href="#friends" role="tab" aria-controls="friends" aria-selected="false">
              <i class="fa fa-users"></i>
              Friends
            </a>
            <a class="nav-link" id="requests-tab" data-toggle="pill" href="#requests" role="tab" aria-controls="requests" aria-selected="false">
              <i class="fa fa-hourglass-half"></i>
              Friend Requests
            </a>
            <a class="nav-link" id="moreSettings-tab" data-toggle="pill" href="#moreSettings" role="tab" aria-controls="moreSettings" aria-selected="false">
              <i class="fa fa-cogs"></i>
              More Settings
            </a>

          </div>
        </div>
        <div class="tab-content p-4" id="v-pills-tabContent">
          <!-- setting  -->

          <div class="tab-pane fade show active" id="account" role="tabpanel" aria-labelledby="account-tab">
            <h3 class="mb-4">Account Settings</h3>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Email</label>
                  <input type="text" class="form-control" disabled value=<?= $_SESSION['user']['email'] ?> />
                </div>
              </div>
              <div class="col-md-6">
                <form method="POST" action="../api/users/editSettings.php" enctype="multipart/form-data">
                  <div class="form-group">
                    <label>Username</label>
                    <input name="new-username" type="text" class="form-control" value=<?php echo '"' . $_SESSION['user']['username'] . '"' ?>>
                  </div>
              </div>
              <label>Change Profile Image</label>
              <input type="file" name="profile_image_change">
            </div>
            <br>
            <button name="update-settings-btn" class="btn event" style="color: white">Update</button>
            </form>
          </div>


          <!-- passsword -->

          <div class="tab-pane fade" id="password" role="tabpanel" aria-labelledby="password-tab">
            <h3 class="mb-4">Password Settings</h3>
            <div class="row">
              <div class="col-md-6">
                <form method="POST" action="../api/users/editPassword.php">
                  <div class="form-group">
                    <label>Old password</label>
                    <input required name="old-password" type="password" class="form-control" />
                  </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>New password</label>
                  <input required name="new-password-1" type="password" class="form-control" />
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Confirm new password</label>
                  <input required name="new-password-2" type="password" class="form-control" />
                </div>
              </div>
            </div>
            <div>
              <button name="password-change-btn" class="btn event" style="color: white">Update</button>

            </div>
            </form>
          </div>

          <!-- All events -->
          <div class="tab-pane fade" id="favorites" role="tabpanel" aria-labelledby="favorites-tab">
            <h3 class="mb-4">My Events</h3>
            <div class="row">
              <?php
              if (isset($events_arr)) {

                foreach ($events_arr as $user_event) {
                  $event_id = $user_event['event_id'];
                  include "../api/users/check_favorite.php";
                  include "../api/users/check_reservation.php";
              ?>
                  <div class="card card-decoration col-md-4 cardSettings">
                    <img class="card-img-top card-image" src="<?= "../" . $user_event['image'] ?>" alt="favorite event" />
                    <div class="card-body">
                      <h5 class="card-title"><?php echo $user_event['title'] ?></h5>
                      <div class="downbuttons">
                        <div class="theRow">
                          <div class="item-1">
                            <a href="event-content.php?event_id=<?= $user_event['event_id'] ?>" class="btn event" style="color: white">Browse</a>
                          </div>
                          <div class="item-2 icons">
                          <?php
                              if($is_reserved){ ?>
                                <img  class = "ticket-icon" src = '/media/icons8-ticket.png' onclick = <?php echo "reservationChecker(this,".$event_id. ",". $_SESSION['user']['user_id']. ")";?>>
                            <?php } else {
                                  if ($user_event['num_tickets'] != $user_event['reserved_tickets'])
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


          <!-- friends -->
          <div class="tab-pane fade" id="friends" role="tabpanel" aria-labelledby="friends-tab">
            <div class="container">
              <div class="row">
                <div class="col-12 col-md-6 col-lg-6 d-flex align-items-center mt-3 mt-md-0">
                  <h3 class="mb-4">Friends</h3>
                </div>
                <div class="col-12 col-md-6 col-lg-6 d-flex align-items-center justify-content-md-end mt-3 mt-md-0">
                  <form action="../api/users/sendRequest.php" method="POST">
                    <div class="form-inline my-2 my-lg-0">
                      <input required id="search_id" class="form-control mr-sm-2" type="search" name="username" placeholder="Search on user" aria-label="Search" onkeyup="search(this.value)" />
                      <button class="btn event my-2 my-s m-0" style="color: white" name="send-request-btn">
                        Send Request
                      </button>
                    </div>
                    <div id="suggestions-list"></div>
                  </form>
                </div>
              </div>

            </div>

            <ul class="list-group col-md-12">
              <?php if (isset($friends_arr)) {
                foreach ($friends_arr as $friend) {
                  $friend_id = $friend["friend_id"];
                  $friend_image = "../" . $friend["profile_image"];
                  $friend_username = $friend["username"];

              ?>
                  <li class="list-group-item">
                    <div class="container">
                      <div class="row">
                        <div class="col-md-3 tocenter friend-img">
                          <img class="friend-image" alt="username" src="<?= $friend_image ?>" />
                        </div>
                        <div class="col-md-4 tocenter">
                          <h4><?= $friend_username ?></h4>
                        </div>
                        <div class="col-md-5 tocenter">
                          <div>
                            <a href="friendPage.php?friend_username=<?= $friend_username ?>&friend_id=<?= $friend_id ?>" class="btn event" style="color: white">
                              Show Profile
                            </a>
                            <a href="../api/users/removeFriend.php?friend_id=<?= $friend_id ?>" class="btn btn-danger remobtn">Remove</a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </li>
              <?php }
              } ?>
            </ul>
          </div>

          <!-- Request -->
          <div class="tab-pane fade" id="requests" role="tabpanel" aria-labelledby="requests-tab">
            <h3 class="mb-4">Friend Requests</h3>
            <ul class="list-group col-md-12">
              <?php
              if (isset($requests_arr)) {
                foreach ($requests_arr as $request_person) {
                  $username = $request_person['username'];
                  $sender_id = $request_person['user_id'];
                  $profile_image = $request_person['profile_image'];

              ?>

                  <li class="list-group-item">
                    <div class="container">
                      <div class="row">

                        <div class="col-md-3 tocenter friend-img">
                          <img class="friend-image" src="<?= '../' . $profile_image ?>" />
                        </div>
                        <div class="col-md-4 tocenter">
                          <h6><?= $username ?></h6>
                        </div>
                        <div class="col-md-5 tocenter">
                          <div>
                            <a href="../api/users/confirmRequest.php?sender_id=<?= $sender_id ?>&receiver_id=<?= $_SESSION['user']['user_id'] ?>" class="btn event" style="color: white">
                              accept
                            </a>
                            <a href="../api/users/rejectRequest.php?sender_id=<?= $sender_id ?>&receiver_id=<?= $_SESSION['user']['user_id'] ?>" class="btn btn-danger rejbtn">reject</a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </li>

                <?php }
              } else { ?>
                <h5>No requests</h5>
              <?php } ?>
            </ul>
          </div>
          <!-- More Settings -->
          <div class="tab-pane fade" id="moreSettings" role="tabpanel" aria-labelledby="moreSettings-tab">
            <div class="row">
              <h3 class="mb-4">More Settings</h3>
              <div class="container">
                <div class="row">
                  <div class="col-12 col-md-6 col-lg-6 d-flex align-items-center mt-3 mt-md-0">
                    <h5>Delete Account</h5>
                  </div>
                  <div class="col-12 col-md-6 col-lg-6 d-flex align-items-center justify-content-md-end mt-3 mt-md-0">
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">
                      DELETE
                    </button>
                  </div>
                  <!-- Modal -->
                  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">
                            Delete dialog
                          </h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          Are you sure that you want to delete your account?
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Close
                          </button>
                          <form action="../api/users/delete_user_account.php" method='POST'>
                            <input type="hidden" name="user-id-delete" value="<?= $_SESSION['user']['user_id'] ?>" />
                            <button name="delete-account-btn" type="submit" class="btn btn-danger">
                              DELETE
                            </button>
                          </form>
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