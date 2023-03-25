<?php
session_start();
include "koneksi.php";
$kon = new Koneksi();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Retrieve the input values
  $nrp = $_POST['tnrp'];
  $password = md5($_POST['tpass']);
  if (empty($_POST['tnrp']) || empty(md5($_POST['tpass']))) {
    $error = 'Masukan NRP and password.';
  } else {
    $abc = $kon->kueri("SELECT * FROM tb_mahasiswa WHERE nrp='$nrp' AND pass = '$password' ");
    $user = $kon->hasil_data($abc);
    if (!$user) {
      $error = 'Invalid NRP atau password.';
    } else {
      // Check if the password matches the hshed password stored in the database
      if (($password == $user[pass])) {
        // Passwords match, so create a session for the user and redirect to a secured page
        $_SESSION['mahasiswa_id'] = $user['id_mahasiswa'];
        $_SESSION['nama'] = $user['nama_mahasiswa'];
        $_SESSION['rfid'] = $user['id_rfid'];
        $_SESSION['nrp'] = $user['nrp'];
        header('Location: index.php');
        exit;
      } else if ($password != $user[pass]) {
        // Passwords do not match, so display an error message
        $error = 'Invalid NRP/email atau password.';
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
  <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
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
          <h2 class="title">Login</h2>
          <?php
          // Display any error messages
          if (isset($error)) {
            echo '<p>' . $error . '</p>';
          }
          ?>
          <div class="input-field">
            <i class="fas fa-user"></i>
            <input type="text" placeholder="NRP" name="tnrp" />
          </div>
          <div class="input-field">
            <i class="fas fa-lock"></i>
            <input type="password" placeholder="Password" name="tpass" />
          </div>
          <input type="submit" name="submit" value="Login" class="btn solid" />

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