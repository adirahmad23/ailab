<?php
if (isset($_GET["rfid"])) {
    $postmhsw = $_GET["rfid"];
    $Write = "<input type='text' name='trfid'  class='form-control' value='$postmhsw' readonly>";
    file_put_contents('tmpmhsw.php', $Write);
} else {
    $Write = "<input type='text' name='trfid'  class='form-control' value='' readonly>";
    file_put_contents('tmpmhsw.php', $Write);
}
