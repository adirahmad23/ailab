<?php
if (isset($_GET['rfid'])) {
    $postmhsw = $_GET['rfid'];
    $Write = "<input class='col-form-label rounded' style='border-color:blue' type='text' name='rfid' id='ktmInput' value='$postmhsw' readonly>";
    file_put_contents('tmpbalik.php', $Write);
}
