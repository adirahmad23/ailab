<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tes Barang</title>
</head>

<body>
    <?php
    $link = "barang";
    $url = link();
    $response = file_get_contents($url);
    echo $response;
    ?>
</body>

</html>