<?php
  session_start();
  if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit();
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../style/addevent.css" />
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
    <title>Add event</title>
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
              <h3 class="mb-4 text-center">Add Event</h3>
              <form action="../api/events/createEvent.php" method = "POST" enctype="multipart/form-data" >
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label id = "title">Title</label>
                    <input name = "title" required type="text" class="form-control" id = "title" />
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for = "body">Description</label>
                    <textarea name = "body" id = "body" required class="form-control" rows="4"></textarea>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for = "image">Choose Image</label>
                    <input required type="file" class="form-control" name = "image" id = "image" />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="inputState">Category</label>
                    <select name = "category" required id="inputState" class="form-control">
                    <option value="" disabled selected>Choose...</option>
                     <option>Arts & Culture</option>
                     <option>Fikas</option>
                      <option>Parties</option>
                      <option>Seminars</option>
                      <option>Sports</option>
                      <option>Trips</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="date">Event Date</label>
                    <input name = "event_date" required type="datetime-local" class="form-control" id="date" />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="num_tickets">Number of tickets</label>
                    <input required name = "num_tickets" type="number" class="form-control" id="num_tickets" />
                  </div>
                </div>
              </div>
              <div>
                <button class="btn event" style="color: white" name = 'Submit' >Publish</button>
              </div>
              </form>
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
