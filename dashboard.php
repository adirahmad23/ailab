<!DOCTYPE html>
<html lang="en">
        <?php
   if ($_SERVER['REQUEST_METHOD'] == 'POST') {


session_start();

unset($_SESSION["user_id"]);

// unset($_SESSION["jenislomba"]);
// unset($_SESSION["level"]);


    header('Location: index.php'); // default page
    }
    ?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method = "post">
        <input type="submit" name="logout" class="btn solid" />
    </form>


</body>
</html>