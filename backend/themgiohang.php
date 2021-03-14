<?php
	include('../lib_db.php');
	$idkh = substr($_POST['idkh'],2);
	$idsp = $_POST['idsp'];
	$amount = $_POST['amount'];
	$sql = "select * from customer_information where id = $idkh"; 
	$data = select_one($sql);
	$table = "bill";
	$dulieu['idhd'] = "";
	$dulieu['idkh'] = $idkh;
	$dulieu['idsp'] = $idsp;
	$dulieu['amount'] = $amount;
	$dulieu['totalmoney'] = "";
	$dulieu['timeorder'] = "";
	$dulieu['deliveryaddress'] = $data['address'];
	$dulieu['status'] = "TrongGio";
	$sql2 = "select total from product where id = $idsp";
	$sl=select_one($sql2)['total']-$amount;
	if($sl>=0)
	{
		exec_update(data_to_sql_insert($table,$dulieu));
		exec_update("UPDATE product set total = $sl where id = $idsp");
		exec_update("UPDATE bill INNER JOIN product on bill.idsp = product.id set bill.totalmoney = bill.amount * product.price");
	}
	else
	{
		echo "Số lượng mặt hàng không đủ số lượng trong kho còn ".select_one($sql2)['total'];
	}
	
?>