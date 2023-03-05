      <?php
   // if ($_SERVER['REQUEST_METHOD'] == 'POST') {


session_start();

unset($_SESSION["teknisi_id"]);

// unset($_SESSION["jenislomba"]);
// unset($_SESSION["level"]);


    header('Location: login.php'); // default page
   //  }
    ?>