<?php
session_start();
include_once "../proses/koneksi.php";
$kon = new Koneksi();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Retrieve the input values
  $username = $_POST['tteknisi'];
  $pass = md5($_POST['tpass']);
  if ($pass == 0) {
    $error = 'Masukan NRP/Email and password.';
  } else {
    // Perform validation on the input values
    if (empty($_POST['tteknisi']) || empty(md5($_POST['tpass']))) {
      $error = 'Masukan NRP/Email and password.';
    } else {

      $abc = $kon->kueri("SELECT * FROM tb_teknisi WHERE nama_teknisi='$username' AND pass = '$pass'");
      $user = $kon->hasil_data($abc);
      if (!$user) {
        $error = 'Invalid NRP/email atau password.';
      } else {
        // Check if the password matches the hshed password stored in the database
        if (($pass == $user['pass'])) {
          // Passwords match, so create a session for the user and redirect to a secured page
          $_SESSION['teknisi_id'] = $user['id_teknisi'];
          header('Location: index.php');
          exit;
        } else if ($pass != $user['pass']) {
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
  <!-- <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="assets\css\login\login.css" /> -->
  <!-- Favicons -->
  <link href="img/logo.png" rel="icon">
  <title>Login Mahasiswa</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css">
  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">

  <!-- css -->
  <link href="login.css" rel="stylesheet">
</head>

<body>

  <style>
    body {
      background-image: url('img/background.png');
      background-size: cover;

    }
  </style>

  <div class="container">
    <div class="row align-items-center justify-content-center vh-100">
      <div class="col-md-7">
        <img src="img/y.png" class="w-100" ;>
      </div>
      <div class="col-md-5">
        <form class="register-form" method="post">
          <?php
          // Display any error messages
          if (isset($error)) {
            echo '<p>' . $error . '</p>';
          }
          ?>
          <div class="p-4 text-center">
            <h4>Selamat Datang</h4>
            <p>Masukkan Username dan Password Anda</p>
          </div>
          <div class="mb-3">
            <label for="text" class="form-label">Username</label>
            <input type="text" class="form-control" name="tteknisi" placeholder="Masukkan Username">
          </div>
          <div class="mb-4">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" name="tpass" placeholder="Password">
          </div>

          <div class="mb-3 py-4">
            <button type="submit" class="btn btn-primary w-100">Masuk</button>
          </div>

        </form>
      </div>
    </div>
  </div>

  <script src="assets/css/login/app.js"></script>
</body>

</html>