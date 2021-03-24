<?php
	include("lib_db.php"); 
    session_start();
    $datavote['vote'] = "0";
    $id = isset($_SESSION['idkh']) ? $_SESSION['idkh'] : '';
    if(isset($_POST["logout"]))
    {
        unset($_SESSION['idkh']);
        setcookie("username", "", time()-3600);
        setcookie("password", "", time()-3600);
        header("location:Home.php");
    }
    if($id != "")
    {
    	$sql1 = "select * from customer_information where id = '$id'";
        $data1 = select_one($sql1);
        $sql2 = "SELECT COUNT(bill.idsp) as sl FROM bill WHERE bill.idkh = $id AND bill.status = 'TrongGio';";
        $datasl = select_one($sql2);
    }
    $sqlgiohang =  "select * from bill inner join product on bill.idsp = product.id where bill.idkh = $id and bill.status = 'TrongGio'";
    $datagiohang = select_list($sqlgiohang);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Nhạc Cụ Việt</title>
	<link rel="icon" type="images/png" href="img/logo1.ico">  
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css"/>
    <link href="fontawesome/css/all.css" rel="stylesheet">
    <script type="text/javascript" src="bootstrap/js/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" src="./bootstrap/js/bootstrap.min.js"></script>  
    <link rel="stylesheet" type="text/css" href="css/header.css">
    <link rel="stylesheet" type="text/css" href="css/footer.css">
    <link rel="stylesheet" type="text/css" href="css/Home.css">
    <link rel="stylesheet" type="text/css" href="css/sanpham.css">
</head>
<body>
	<script type="text/javascript">
			var list = [];
			var danhsach = [];
			function tinhtien(i)
			{

				if(document.getElementById("sp"+i).checked == true)
				{
					danhsach.push(i);
					let toanbotien = document.getElementById("toanbotien").innerHTML;
					let tienmoi = document.getElementById("tongtien"+i).innerHTML;
					document.getElementById("toanbotien").innerHTML =parseFloat(toanbotien) + parseFloat(tienmoi);
					
				}	
				else
				{
					danhsach.splice(danhsach.indexOf(i),1);
					let toanbotien = document.getElementById("toanbotien").innerHTML;
					let tienmoi = document.getElementById("tongtien"+i).innerHTML;
					document.getElementById("toanbotien").innerHTML = parseFloat(toanbotien) - parseFloat(tienmoi)
					
				}
			}
			function tienhangdathang()
			{
				if(danhsach == '')
				{
					alert('Bạn chưa chọn sản phẩm đặt hàng');
				}	
				else
				{
					$.post('backend/tienhanhdathang.php',{'danhsach':danhsach},function(data){location.reload();});
				}
			}
			function selectall()
			{
				if(document.getElementById("selectall").checked)
				{
					document.getElementById("toanbotien").innerHTML = "0";
					danhsach = list;
					list.forEach(element =>{
					document.getElementById("sp"+element).checked = true;
					let toanbotien = document.getElementById("toanbotien").innerHTML;
					let tienmoi = document.getElementById("tongtien"+ element).innerHTML;
					document.getElementById("toanbotien").innerHTML =parseFloat(toanbotien) + parseFloat(tienmoi);
					} );
					
				}
				else
				{
					danhsach = [];
					list.forEach(element => document.getElementById("sp"+ element).checked = false);
					document.getElementById("toanbotien").innerHTML = "0";
					
				}
			}
			
	</script>
	<?php require_once('header.php'); ?>
	<style type="text/css">
		input:checked{
			background-color: #feaf37;
		}
	</style>
	<div class="container-fluid" style="height: 100px;"></div>
	<div class="container">
		<h1 style="margin-left: 40%;font-weight: bold;color: #000000cc;">ĐẶT HÀNG</h1>
	</div>	
	<div class="container">
		<div class="address" style="height: 70px; width: 100%; border-bottom: 1px solid gray">
			<h2 style="font-size: 20px;"><i style="margin-right: 3px;color: #feaf37" class="fas fa-map-marker-alt"></i>Địa chỉ nhận hàng</h2>
			<span><?php echo $data1['fullname']; ?></span><b style="margin-left: 10px;margin-right: 10px;"><?php echo $data1['numberphone']; ?></b><span style=""><?php echo $data1['address']; ?></span><a  style="margin-left: 10px;color: #feaf37 " href="#">Thay Đổi</a>
		</div>
	</div>
	<div class="container">           
	  	<table class="table table-hover">
		    <thead>
		      	<tr>
		      		<th style="text-align: center;width: 50px;">CHỌN</th>
			        <th style="text-align: center;">HÌNH ẢNH</th>
			        <th style="text-align: center;">TÊN</th>
			        <th style="text-align: center;">GIÁ</th>
			        <th style="text-align: center;">SỐ LƯỢNG</th>
			        <th style="text-align: center;">TỔNG GIÁ</th>
		      	</tr>
		    </thead>
		    <tbody>
		    	<?php
		    	
		    	 foreach ($datagiohang as $key) 
		    	 {
		    	 	
		    	 	?>
		    	 	<script type="text/javascript">
		    	 		list.push("<?php echo $key['idhd']; ?>");
		    	 	</script>
		    	 	<tr>
			      		<td style="text-align: center;"><input onclick="tinhtien(<?php echo $key['idhd']; ?>)" style="" type="checkbox" name="" id="sp<?php echo $key['idhd']; ?>"></td>
				        <td style="width: 150px;height: 80px;"><img src="<?php echo $key['avatar']; ?>" style="height: 100%;width: 50%;margin-left:15%;"></td>
				        <td style="text-align: center;"><a href="chitietsanpham.php?idsp=<?php echo $key['idsp']; ?>"><?php echo $key['name']; ?></a></td>
				        <td style="text-align: center; color: #f23333;"><?php echo number_format($key['price']); ?></td>
				        <td style="text-align: center;"><span style="border: 1px solid gray; border-radius: 50%;padding: 5px;padding-left: 9px;padding-right: 9px;"><?php echo $key['amount']; ?></span></td>
				        <td style="text-align: center; color: #f23333;"><span id="tongtien<?php echo $key['idhd']; ?>" style="color: #f23333;display: none;"><?php echo $key['totalmoney']; ?></span><span  style="color: #f23333;"><?php echo number_format($key['totalmoney']); ?></span>₫</td>
			      	</tr>
		    	 	<?php
		    	 	
		    	 }
		    	?>
		      	
		      	<tr>
		      		<td colspan="6">
		      			<input style="margin-right: 10px;" id="selectall" type="checkbox" name="" onclick="selectall()" ><span>Chọn Tất Cả</span>
		      		</td>
		      	</tr>
		      	<tr>
		      		<td colspan="3">TỔNG TIỀN ĐÃ CHỌN</td>
		      		<td colspan="3" style="text-align: right;font-size: 20px;color: #f23333;"><span id="toanbotien" style="text-align: right;font-size: 20px;color: #f23333;">0</span>₫</td>
		      	</tr>
		      	
		    </tbody>
	  	</table>
	</div>
	<div class="container">
		<div class="dathang">
			<button style="padding: 10px; padding-left: 50px;padding-right: 50px;text-align: center;background-color: #231f20;color: #fff;border-radius: 4px;margin-top: 20px;margin-bottom: 20px;margin-left: 50px;animation: nhaylennhaylen .5s ease-out;float: right;" type="button" onclick="tienhangdathang()">Đặt Hàng</button>
		</div>
	</div>
	<?php require_once('footer.php'); ?>
</body>
</html>