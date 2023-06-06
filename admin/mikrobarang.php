<?php

if (isset($_GET["rfid"])) {
    $postbarang = $_GET["rfid"];
    $Write = "<input type='text' name='tkdbarang' class='form-control' value='$postbarang' readonly>";
    file_put_contents('tmpbarang.php', $Write);
} else {
    $Write = "<input type='text' name='tkdbarang' class='form-control' value='' readonly>";
    file_put_contents('tmpbarang.php', $Write);
}
