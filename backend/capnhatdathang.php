<?php
	include('../lib_db.php');
	$idhd = $_POST['idhd'];
	$sql = "UPDATE bill SET status = 'DaDat', timeorder = now() WHERE idhd = $idhd;";
	exec_update($sql);
?>