<?php
	$postbarang=$_POST["rfid"];
	$Write="<input type='text' name='tkdbarang'  class='form-control' value='$postbarang'>";
	file_put_contents('tmpbarang.php',$Write);
?>