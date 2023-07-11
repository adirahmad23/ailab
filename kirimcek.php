<?php
if (isset($_POST['kurang'])) {
    $nilai =  $_POST['kuantiti'];
    $kuantiti = $nilai - 1;
    echo $kuantiti;
} else {
    $kuantiti = $nilai;
}
