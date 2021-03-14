<?php
	include('../lib_db.php');
	$idhd = $_POST['idhd'];
	$sql = "DELETE from bill where idhd = $idhd";
	exec_update($sql);
?>