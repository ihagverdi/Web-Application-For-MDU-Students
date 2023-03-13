<?php 
  session_start();
  if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit();
  }
include_once "../api/events/readEventSingleTitle.php";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../style/editPage.css" />
    <link
      rel="stylesheet"
      type="text/css"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    />
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi"
      crossorigin="anonymous"
    />
    <title>Edit event</title>
  </head>
  <body>
  <header class="header-container">
    <a  id="logo" href="index.php"><img src="/media/MDU.svg" /></a>
      <div class="icons">
        <a href="../sessions/destroy_session.php" id="logout-btn">Logout</a>
      </div>

    </header>
    <!-- editPage -->
    <section class="my-3">
      <div class="container">
        <div class="bg-white shadow rounded-lg d-block d-sm-flex">
          <div class="all">
            <div
              class="tab-pane fade show active"
              id="account"
              role="tabpanel"
              aria-labelledby="account-tab"
            >
              <h3 class="mb-4 text-center">Edit event</h3>
              <form action="../api/events/updateEvent.php?event_id=<?=$event_item['event_id']?>" method="POST" enctype="multipart/form-data">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Title</label>
                      <input name = "title" type="text" class="form-control" value="<?=$event_item['title']?>" />
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Description</label>
                      <textarea name = "body" class="form-control" rows="4"><?=$event_item['body']?></textarea>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Choose File</label>
                      <input name = "image" type="file" class="form-control" />
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="inputState">Category</label>
                      <select name = "category" id="inputState" class="form-control">
                        <option 
                        <?php if ($event_item['category'] == "Arts & Culture") {echo "selected";} ?>
                        >Arts & Culture</option>
                        <option
                        <?php if ($event_item['category'] == "Fikas") {echo "selected";} ?>
                        >Fikas</option>
                        <option
                        <?php if ($event_item['category'] == "Parties") {echo "selected";} ?>
                        >Parties</option>
                        <option
                        <?php if ($event_item['category'] == "Seminars") {echo "selected";} ?>
                        >Seminars</option>
                        <option
                        <?php if ($event_item['category'] == "Sports") {echo "selected";} ?>
                        >Sports</option>
                        <option
                        <?php if ($event_item['category'] == "Trips") {echo "selected";} ?>
                        >Trips</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="date">Date</label>
                      <input name = "event_date" type="datetime-local" class="form-control" id="date" value = "<?=$event_item['event_date']?>" />
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="num-tickets">Number of tickets</label>
                      <input name = "num_tickets" type="number" class="form-control" id="num-tickets" value = "<?=$event_item['num_tickets']?>" />
                    </div>
                  </div>
                </div>
                <div>
                  <button class="btn event" style="color: white">Update</button>
              </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  </body>
</html>
