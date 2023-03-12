<?php
	$postmhsw=$_POST["rfid"];
	$Write="<input type='text' name='trfid'  class='form-control' value='$postmhsw' readonly>";
	file_put_contents('tmpmhsw.php',$Write);
?>