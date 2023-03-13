<?php
  session_start();
  if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit();
  }
?> 
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://fonts.googleapis.com/css?family=Source+Sans+Pro"
      rel="stylesheet"
      type="text/css"
    />

    <link rel="stylesheet" href="../style/admin.css" />
    <title>Admin</title>
  </head>
  <body>

    <header class="header-container">
    <a  id="logo" href="index.php"><img src="/media/MDU.svg" /></a>
      <div class="icons">
        <a href="../sessions/destroy_session.php" id="logout-btn">Logout</a>
      </div>

    </header>
    <div class="adm">ADMIN</div>

    <main class="main">
      <div class="center">
        <h1>Enter event's title </h1>
        <form action = "editPage.php" method = "POST">
          <div class="inputbox">
            <input
              required
              class="form-control"
              type="search"
              id="search_id"
              name = "searchTitle"
              placeholder="search.."
              onkeyup = "search(this.value)"
            />
            <div id = "suggestions-list"></div>
          </div>
          <div class="inputbox butt">
            <button class="theButton" style="width:8.45rem ;">Edit Event</button>
            <button formaction="../api/events/deleteEvent.php" style="width:10rem ;" class="theButton">Remove Event</button>
          </div>
        </form>
          <!-- <h3 for="formFile" class="form-label">
            Enter the file to add a new event
                    </h3>
          <div class="inputbox">  
            <input type="file" id="formFile" />
          </div> -->
          <a href = "../pages/addevent.php">
            <input type="button" class="theButton addbtn" value="Add Event" />
            </a>
       
      </div>
    </main>
    <script src = "../script/live-search-admin.js"></script>
  </body>
</html>
