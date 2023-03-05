      <?php
   if ($_SERVER['REQUEST_METHOD'] == 'POST') {


session_start();

unset($_SESSION["user_id"]);

// unset($_SESSION["jenislomba"]);
// unset($_SESSION["level"]);


    header('Location: index.php'); // default page
    }
    ?>