      <?php
      session_start();
      unset($_SESSION["mahasiswa_id"]);
      unset($_SESSION['nama']);
      unset($_SESSION['rfid']);
      unset($_SESSION['nrp']);
      header('Location: login.php'); // default page
      ?>