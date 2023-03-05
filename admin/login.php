<?php
session_start();
include "koneksi.php";
$kon = new Koneksi();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Retrieve the input values
  $username = $_POST['tteknisi'];
  $pass = md5($_POST['tpass']);
  if ($pass == 0) {
    $error = 'Masukan NRP/Email and password.';
    
  }else{
  // Perform validation on the input values
  if (empty( $_POST['tteknisi']) || empty(md5($_POST['tpass']))) {
    $error = 'Masukan NRP/Email and password.';
  } else {
  
  $abc = $kon->kueri("SELECT * FROM tb_teknisi WHERE nama_teknisi='$username' ");
    $user = $kon->hasil_data($abc);
 if (!$user) {
      $error = 'Invalid NRP/email atau password.';
    } else {
      // Check if the password matches the hshed password stored in the database
      if (($pass == $user[pass])) {
        // Passwords match, so create a session for the user and redirect to a secured page
        $_SESSION['teknisi_id'] = $user['id_teknisi'];
        header('Location: index.php');
        exit;
      } else if($pass != $user[pass]) {
        // Passwords do not match, so display an error message
        $error = 'Invalid NRP/email atau password.';

      }
    }
  }
}
}

?>

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
    <title>Login Mahasiswa</title>
  </head>
  <body>
    <div class="container">
      <div class="forms-container">
        <div class="signin-signup">
                 
         <form method="post">
            <h2 class="title">Sign in</h2>
             <?php
// Display any error messages
if (isset($error)) {
  echo '<p>' . $error . '</p>';
}
?>
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
