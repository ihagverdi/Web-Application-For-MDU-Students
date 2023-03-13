<?php
  // if(isset($_REQUEST['err'])){
  //   echo "<script>Alert('Invalid Credentials')</script>";
  // }
?>
<!DOCTYPE html lang="en"/>
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="/style/style.css" />
    <link
      rel="stylesheet"
      href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
      integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
      crossorigin="anonymous"
    />
    <title>Sign Up</title>
  </head>
  <body>
    <!-- logo section -->
    <div class="split left">
      <div class="centered">
        <div class="col-md-6 text-center">
          <img src="/media/MDU.svg" class="mduLogo" />
        </div>
      </div>
    </div>
    <!-- signup section -->
    <div class="split right mobile-media">
      <div class="centered-form">
        <form method = "POST" action = "../api/users/createUser.php">
          <!-- Email -->
          <div class="form-group">
            <input
              type="email"
              class="form-control"
              id="email"
              placeholder="Email"
              name = "email"
              required
            />
          </div>
          <!-- username -->
          <div class="form-group">
            <input
              type="username"
              class="form-control"
              placeholder="Username"
              name = "username"
              required
            />
          </div>
          <!-- pass -->
          <div class="form-group">
            <input
              type="password"
              class="form-control"
              id="Password"
              placeholder="Password"
              name = "password"
              required
            />
          </div>
          <!-- repass -->
          <div class="form-group">
            <input
              type="password"
              class="form-control"
              id="Repassword"
              placeholder="Re-password"
              name = "repassword"
              required
            />
          </div>
          <div class="form-group">
            <button type="submit" name = "signup_btn" class="btn btn-block login-signin"> Sign Up </button>
          </div>
        </form>
      </div>
    </div>
  </body>
</html>
