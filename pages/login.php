<html lang="en">
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
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <title>login</title>
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
        <form action = "../api/users/checkUser.php" method = "POST">
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
              name = "password"
              placeholder="Password"
              required
            />
          </div>
          <!-- checkbox -->
          <div class="form-group">
            <div class="sigining-up">
              <a href="sign-up.php" class="signup-to-right">SIGN UP?</a>
            </div>
          </div>
          <!-- Google ReCaptcha -->
          <div class="form-group">
            <div class="g-recaptcha" data-sitekey="6LfCmsMiAAAAAKdxq8uJwYkvXeC9wvbf4tX6rNsC" ></div>
          </div>
          <!-- button to login -->
          <div class="form-group">
            <button type="submit" class="btn login-signin btn-block" name = "submit">
              Login
            </button>
          </div>
        </form>
      </div>
    </div>
  </body>
</html>
