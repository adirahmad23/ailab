<?php
$random_number = rand(1, 1000);
$value = "idbarang" . $random_number;
?>


<input type='text' name='tkdbarang' class='form-control' value='<?= $value ?>' readonly>