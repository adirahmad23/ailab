<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script
      src="https://kit.fontawesome.com/64d58efce2.js"
      crossorigin="anonymous"
    ></script>
    <link rel="stylesheet" href="assets\css\login\login.css" />
    <!-- Favicons -->
    <link href="img/logo.png" rel="icon">
    <title>LOGIN</title>
  </head>
  <body>
    <div class="container">
      <div class="forms-container">
        <div class="signin-signup">
                 
         <form method="post">
            <h2 class="title">Sign in</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" placeholder="Username" name="tteknisi" />
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" placeholder="Password" name="tpass" />
            </div>
            <input type="submit" name="submit" class="btn solid" />
            
          </form> 
        </div>
      </div>

      <div class="panels-container">
        <div class="panel left-panel">
          <img src="img/mahasiswi.png" class="image" alt="" />
        </div>
        <div class="panel right-panel">
          <div class="content">
            <button class="btn transparent" id="sign-in-btn">
              Sign in
            </button>
          </div>
        </div>
      </div>
    </div>

    <script src="assets\css\login\app.js"></script>
  </body>
</html>
