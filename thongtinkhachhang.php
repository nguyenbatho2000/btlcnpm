<?php
	include('lib_db.php');
	include('util.php');
	session_start();
	$erro = "";
    $id = isset($_SESSION['idkh']) ? $_SESSION['idkh']:"";
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
       $sqlhang1 = "select * from bill inner join product on bill.idsp = product.id where bill.idkh = $id and bill.status = 'DaDat'";
       $dulieu1 = select_list($sqlhang1);
       $sqlhang2 = "select * from bill inner join product on bill.idsp = product.id where bill.idkh = $id and bill.status = 'DangGiao'";
       $dulieu2 = select_list($sqlhang2);
       $sqlhang3 = "select * from bill inner join product on bill.idsp = product.id where bill.idkh = $id and bill.status = 'DaGiao'";
       $dulieu3= select_list($sqlhang3);
    }
    else
    {
    	header("location:Home.php");
    }
    if(isset($_POST['change_infor_cus']))
    {
    	$cus_fullname = $_REQUEST['cus_fullname'];
    	$cus_sex = $_REQUEST['cus_sex'];
    	$cus_date = $_REQUEST['cus_date'];
    	$cus_address = $_REQUEST['cus_address'];
    	$cus_numberphone = $_REQUEST['cus_numberphone'];
    	$cus_email = $_REQUEST['cus_email'];
    	if( $cus_fullname != "" && $cus_sex != "" && $cus_date != "" && $cus_address != "" && $cus_numberphone != "" && $cus_email != "")
    	{
 
    		$dk = 'id = '.$id;
    		$data_table_cus = "customer_information";
    		$data_change['fullname'] = $cus_fullname;
    		$data_change['sex'] = $cus_sex;
    		$data_change['date'] = $cus_date;
    		$data_change['address'] = $cus_address;
    		$data_change['numberphone'] = $cus_numberphone;
    		$data_change['email'] = $cus_email;
    		$sqlchange_cus = data_to_sql_update($data_table_cus,$data_change,$dk);
    		$checkok = exec_update($sqlchange_cus);
    		if($checkok == "1")
    		{
    			$erro = "Thay đổi thành công";
    		}
    		else
    		{
    			$erro = "Thay đổi thất bại hệ thống gặp trục chặc";
    		}
    	}
    	else
    	{
    		$erro = "Bạn chưa hoàn thành đầy đủ thông tin";
    	}
    }
    if(isset($_POST['change_pass_btn']))
    {
    	$passwordold = md5($_REQUEST['passwordold']);
		$passwordnew = md5($_REQUEST['passwordnew']);
		$repasswordnew = md5($_REQUEST['repasswordnew']);
		if($passwordold != "" && $passwordnew != "" && $repasswordnew != "")
		{
			if($passwordold == $data1['password'])
			{
				if($passwordnew == $repasswordnew)
				{
					$updatepass = "update customer_information set password = '$passwordnew' where id = $id";
					exec_update($updatepass);
					$erro = "Thay đổi thành công";
				}
				else
				{
					$erro = "Mật khẩu nhập lại không chính xác";
				}
			}
			else
			{
				$erro = "Mật khẩu không chính xác";
			}
		}
		else
		{
			$erro = " Chưa nhập đủ thông tin";
		}
    }
    if(isset($_POST['change_img_cus']))
    {
    	$change = upload_file_by_name("ttkh_change_img");
    	$sqlupdateimg = "update customer_information set avatar = '$change' where id = $id";
    	exec_update($sqlupdateimg);
    	header('thongtinkhachhang.php');
    }
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
	<style type="text/css">
		p:hover{text-decoration: none;}
		input:focus{box-shadow: 0 0 0 0.2rem #fff5197a!important; border-color: #ffee80!important;}
		.tpk_card
		{
		  position: absolute;
		  top: 50%;
		  left: 50%;
		  transform: translate(-50%, -50%);
		  width: 300px;
		  height: 400px;
		  transform-style: preserve-3d;
		  perspective: 600px;
		  transition: 0.5s;

		}

		.tpk_card .front
		{
		  position: absolute;
		  top: 0;
		  left: 0;
		  width: 100%;
		  height: 100%;
		  background: #000;
		  backface-visibility: hidden;
		  transform: rotateX(0deg);
		  transition: 0.5s;
		}

		.tpk_card:hover .front
		{
		  transform: rotateX(-180deg);
		}

		.tpk_card .back
		{
		  position: absolute;
		  top: 0;
		  left: 0;
		  width: 100%;
		  height: 100%;
		  background: #000;
		  backface-visibility: hidden;
		  transform: rotateX(180deg);
		  transition: 0.5s;
		}

		.tpk_card .back:before
		{
		  content: '';
		  position: absolute;
		  top: 0;
		  width: 100%;
		  height: 100%;
		  background: rgba(255, 255, 255, 0.1)
		}

		.tpk_card:hover .back
		{
		  transform: rotateX(0deg);
		}

		.tpk_card .back .details
		{
		  position: absolute;
		  top: 50%;
		  left: 0;
		  transform: translate(0,-50%);
		  width: 100%;
		  text-align: center;
		  padding: 20px;
		  box-sizing: border-box;
		}

		.tpk_card .back .details h2
		{
		  margin: 0px;
		  padding: 0px;
		  font-size: 24px;
		  color: #fff;
		  font-family: 'Josefin Sans', sans-serif;
		}

		.tpk_card .back .details h2 span
		{
		  color: #a7a7a7;
		  font-size: 16px;
		  font-family: 'Josefin Sans', sans-serif;
		}

		.tpk_card .social-icons
		{
		  padding: 10px 0;
		}

		.tpk_card .social-icons a
		{
		  display: inline-block;
		  width: 36px;
		  height: 36px;
		  text-align: center;
		  background: #262626;
		  color: #fff;
		  text-decoration: none;
		  border-radius: 50%;
		  transition: 0.5s;
		}

		.tpk_card .social-icons a .fab
		{
		  line-height: 36px;
		}

		.tpk_card .social-icons a:hover
		{
		  background: #e91e63;
		}
		.ttkh_change_infor{
			height: 400px; 
			width: 50%; 
			top: 20%;
			left: 25%;
			position: fixed;
			z-index: 10000;
			border-radius: 5px;
			background-color: #fff;
			box-shadow: 0px 10px 20px 0px gray;
			animation: zoomout 1s ease-out;
		}
		
		.ttkh_change_pass
		{
			
			height: 230px; 
			width: 30%; 
			top: 30%;
			left: 35%;
			position: fixed;
			z-index: 10000;
			border-radius: 5px;
			background-color: #fff;
			box-shadow: 0px 10px 20px 0px gray;
			animation: zoomout 1s ease-out;
		}
		.ttkh_namekh input{
			width: 60%;
			float: left;
			height: 30px;
		}
		.ttkh_namekh select{
			width: 15%;
			height: 30px;
		}
		.ttkh_namekh select option{
			font-size: 13px;
		}
		
		.button{
			background-color: #fff;
			border:0px;
			padding: 10px;
			margin-right: 10px;


		}
		.button:focus{
			border: 0px;
			border-bottom: 1px solid #fdae37;
			color: #fdae37;
			outline: 0px;
		}
		.button:active{
			
			border-bottom: 1px solid #fdae37;
			color: #fdae37;
			
		}
		.city{
			margin-top: 30px;
			background-color: #f5f5f5;
			width: 100%;
			height: 90%;
			overflow: auto;
		}
		.ttkh_ttsp_item{
			width: 98%;
			margin: auto;
			margin-top: 10px;
			margin-bottom: 5px;
			background-color: #fff;
			height: 200px;
		}
		.ttkh_ttsp_item_img{
			margin-top: 5px;
			width: 90%;
			height: 190px;
			margin: auto;
		}
		.huy button{
			float: right;
			margin-right: 20px;
			padding: 5px;
			padding-left: 40px; 
			padding-right: 40px;
			font-size: 13px;
			border: 0px;
			background-color: #fdae37;
		}
		.backchange{
			position: fixed;
			z-index: 10000;
			background-color: #00000054;
			width: 100%;height: 100%;
			display: none;
		}
	</style>
	<script type="text/javascript">
		function change()
		{
			if(document.getElementById("ttkh_change_infor").style.display == "none")
			{
				document.getElementById("ttkh_change_infor").style.display = "block";
			}
			else
			{
				document.getElementById("ttkh_change_infor").style.display = "none";
			}
		}
		function changepass()
		{
			if(document.getElementById("ttkh_change_pass").style.display == "none")
			{
				document.getElementById("ttkh_change_pass").style.display = "block";
			}
			else
			{
				document.getElementById("ttkh_change_pass").style.display = "none";
			}
		}
		function openCity(cityName) {
		  	var i;
		  	var x = document.getElementsByClassName("city");
		  	for (i = 0; i < x.length; i++) {
		   		x[i].style.display = "none";  
		  	}
		  	document.getElementById(cityName).style.display = "block";  
		  	
		}
		function hienanh(id)
		{
			var file = document.getElementById("ttkh_change_img").files[0];
			if (file)
			{
				var reader = new FileReader();
				reader.addEventListener("load",function(){
					document.getElementById("image_cus").setAttribute("src",this.result);

				});
				reader.readAsDataURL(file);
				
		
			}
			

		};
	</script>
	<?php
		if ($erro !="") 
		{
			?>
			<script type="text/javascript">
				alert("<?php echo $erro; ?>");
			</script>
			<?php
		}
	?>
	<?php require_once('header.php') ?>
	<div id="ttkh_change_infor" class="backchange" style="">
		<div class="ttkh_change_infor" >
			<form method="post">
				<div class="close" style="position: absolute;z-index: 100;right: 4%;top: 3%;">
					<i onclick="change()" class="fas fa-times"></i>
				</div>
				<div class="ttkh_namekh" style="width: 50%;float: left;">
					<p style="color: #777777;float: left;margin-right: 27px;margin-top: 7px;margin-left: 20px;font-family: Lato">Họ Tên :</p>
					<input value="<?php echo $data1['fullname'] ?>" class="form-control" type="text" name="cus_fullname"><span style="margin-left: 3px; color: red">*</span>
				</div>
				<div class="ttkh_namekh" style="margin-top: 50px;width: 100%;">
					<p style="color: #777777;float: left;margin-right: 10px;margin-top: 7px;font-family: Lato">Giới Tính :</p>
					<select class="form-control"  style="width: 210px;" name="cus_sex">
						<?php
						if($data1['sex']=="Nam")
						{
							?>
							<option value="Nam">Nam</option>
							<option value="Nữ">Nữ</option>
							<?php
						}
						else
						{
							?>
							<option value="Nữ">Nữ</option>
							<option value="Nam">Nam</option>
							<?php
						}
						?>
					</select>
				</div>
				<div class="ttkh_namekh" style="margin-top: 20px;width: 100%; float: left;">
					<p style="color: #777777;float: left;margin-right: 10px;margin-top: 7px;margin-left: 20px;font-family: Lato">Ngày sinh :</p>
					<input style="float: left;width: 25%;" class="form-control" type="datetime-local" name="cus_date" value="<?php echo $data1['date'] ?>">
					<p style="color: #777777;float: left;margin-right: 10px;margin-top: 7px;margin-left: 20px;font-family: Lato">Địa Chỉ :</p>
					<input style="width: 40%;"  class="form-control" type="text" name="cus_address" value="<?php echo $data1['address'] ?>"><span style="margin-left: 3px; color: red" >*</span>
				</div>
				<div class="ttkh_namekh" style="margin-top: 130px;width: 100%;">
					<p style="color: #777777;float: left;margin-right: 10px;margin-top: 7px;margin-left: 20px;font-family: Lato">SĐT :</p>
					<input style="width: 565px;" class="form-control" type="text" name="cus_numberphone" value="<?php echo $data1['numberphone'] ?>"><span style="margin-left: 3px; color: red">*</span>
				</div>
				<div class="ttkh_namekh" style="margin-top: 50px;width: 100%;">
					<p style="color: #777777;float: left;margin-right: 10px;margin-top: 7px;margin-left: 20px;font-family: Lato">Email :</p>
					<input style="width: 555px;" class="form-control" type="text" name="cus_email" value="<?php echo $data1['email'] ?>"><span style="margin-left: 3px; color: red">*</span>
				</div>
				<div class="ttkh_namekh" style="margin-top: 30px;width: 100%;">
					<button type="submit" name="change_infor_cus" style="border-radius: 5px; color: #fff;background-color: #fdae37;font-size: 13px;margin-left: 50px;" class="btn btn-white">Lưu</button>
				</div>
			</form>
		</div>
	</div>
	<div id="ttkh_change_pass" class="backchange" style="">
		<div class="ttkh_change_pass" >
			<form method="post">
				<div class="close" style="position: absolute;z-index: 100;right: 4%;top: 3%;">
					<i onclick="changepass()" class="fas fa-times"></i>
				</div>
				<div class="ttkh_namekh" style="width: 100%;margin-top: 20px;height: 50px;">
					<p style="color: #777777;float: left;margin-right: 10px;margin-top: 7px;margin-left: 20px;font-family: Lato">Mật Khẩu Cũ :</p>
					<input style="width: 50%;margin-left: 20px;" class="form-control" type="password" name="passwordold">
				</div>
				<div class="ttkh_namekh" style="width: 100%;height: 50px;">
					<p style="color: #777777;float: left;margin-right: 10px;margin-top: 7px;margin-left: 20px;font-family: Lato">Mật Khẩu Mới :</p>
					<input style="width: 50%;margin-left: 13px;" class="form-control" type="text" name="passwordnew">
				</div>
				<div class="ttkh_namekh" style="width: 100%;height: 50px;">
					<p style="color: #777777;float: left;margin-right: 10px;margin-top: 7px;margin-left: 20px;font-family: Lato">Nhập lại mk Mới :</p>
					<input style="width: 50%;" class="form-control" type="password" name="repasswordnew">
				</div>
				<div class="ttkh_namekh" style="width: 100%;">
					<button name="change_pass_btn" type="submit" style="border-radius: 5px; color: #fff;background-color: #fdae37;font-size: 11px;margin-left: 20px;" class="btn btn-white">Thay đổi</button>
				</div>
			</form>
		</div>
	</div>
	<div class="container-fluid" style="height: 100px;"></div>

	<div class="container" style="margin-bottom: 50px;">
		<div class="row" style="padding-top: 10px;padding-bottom: 10px;animation: moveInLeft 1s ease-out;">
			<div class="col-5" style="">
				<div class="ttkh_img" style="width: 70%;height: 450px;margin: auto;">
					<form method="post" enctype="multipart/form-data">
						<div class="tpk_card">
						  	<div class="front"><img id="image_cus" src="<?php echo $data1['avatar']; ?>" style="width: 100%;height: 100%;"></div>
						      <div class="back">
						        <div class="details">
						          <h2><?php echo $data1['fullname']; ?><br><span>Đẹp zai tốt bụng</span></h2>
						          <div class="social-icons">
						            <a href="#"><i class="fab fa-facebook-f"></i></a>
						            <a href="#"><i class="fab fa-twitter"></i></a>
						            <a href="#"><i class="fab fa-google-plus-g"></i></a>
						            <a href="#"><i class="fab fa-instagram"></i></a>
						            <a href="#"><i class="fab fa-linkedin-in"></i></a>
						          </div>
						        </div>
						    </div>
						    <a  href="#" style="width: 100%; position: absolute;z-index: 1000; height: 50px; bottom: 0px; background-color: #00000091">
							    <label for="ttkh_change_img" class="ttkh_change_img" >					    	
							    	<i  style="font-size: 30px;margin-left: 135px;color: #fff;margin-top: 12px;" class="fas fa-camera"></i>					    
							    	<input onchange="hienanh(<?php echo $id; ?>)" id="ttkh_change_img" type="file" name="ttkh_change_img" style="display: none;">
							    </label>
						    </a>
						</div> 
						<div class="form-group" style="position: absolute;bottom: -50px;width: 300px;margin-left: 5px;">
							<button type="submit" name="change_img_cus" class="form-control">Lưu</button>
						</div>
					</form> 
				</div>
			</div>
			<div class="col-7" style="">
				<div class="ttkh_infor" style="margin-left: 80px;">
					<div class="ttkh_namekh" style="margin-top: 30px;width: 100%;">
						<p style="color: #777777;float: left;margin-right: 10px">Họ Tên :</p>
						<span style="color: #231f20"><?php echo $data1['fullname']; ?><span style="margin-left: 3px; color: red">*</span></span>
					</div>
					
					<div class="ttkh_namekh" style="margin-top: 30px;width: 50%;">
						<p style="color: #777777;float: left;margin-right: 10px;">Ngày Sinh :</p>
						<span style="color: #231f20"><?php echo $data1['date']; ?></span>
					</div>
					<div class="ttkh_namekh" style="margin-top: 30px;width: 50%;">
						<p style="color: #777777;float: left;margin-right: 10px;">Giới Tính :</p>
						<span style="color: #231f20"><?php echo $data1['sex']; ?></span>
					</div>
					<div class="ttkh_namekh" style="margin-top: 30px;width: 100%;">
						<p style="color: #777777;float: left;margin-right: 10px;">Địa Chỉ :</p>
						<span style="color: #231f20"><?php echo $data1['address']; ?></span>
					</div>
					<div class="ttkh_namekh" style="margin-top: 30px;width: 50%;">
						<p style="color: #777777;float: left;margin-right: 10px;">Số Điện Thoại :</p>
						<span style="color: #231f20"><?php echo $data1['numberphone']; ?><span style="margin-left: 3px; color: red">*</span></span>
					</div>
					<div class="ttkh_namekh" style="margin-top: 30px;width: 50%;">
						<p style="color: #777777;float: left;margin-right: 10px;">Email :</p>
						<span style="color: #231f20"><?php echo $data1['email']; ?><span style="margin-left: 3px; color: red">*</span></span>
					</div>
					<div class="ttkh_namekh" style="margin-top: 30px;width: 100%;">
						<a onclick="change()" style="color: #007bff; font-size: 14px;margin-right: 100px;" href="#">Thay đổi thông tin</a>
						<a onclick="changepass()" style="color: #007bff; font-size: 14px;" href="#">Thay đổi mật khẩu</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="container" style="margin-bottom: 50px;">
		<div class="ttkh_ttsp" style="height: 1000px;border-bottom: 1px solid black;">
			<div class="ttkh_ttsp_top" style="width: 100%;border-top: 1px solid gray;">
				<button class="button" onclick="openCity('ttkh_dathang')">Đã đặt hàng</button>
			 	<button class="button" onclick="openCity('ttkh_vanchuyen')">Đang vận chuyển</button>
			 	<button class="button" onclick="openCity('ttkh_dagiao')">Đã giao hàng</button>
			</div>
			

			<div id="ttkh_dathang" class="city" style="animation: moveTop 1s ease-out;">
				<?php
				foreach ($dulieu1 as $key) 
				{
					?>
					<div class="ttkh_ttsp_item">
				 		<div class="row">
				 			<div class="col-3">
				 				<div class="ttkh_ttsp_item_img" style="">
				 					<img src="<?php echo $key['avatar']; ?>" style="width: 100%;height: 100%;" alt="">
				 				</div>			 				
				 			</div>
				 			<div class="col-9">
				 				<div class="ttkh_ttsp_item_ctsp" style="width: 50%;float: left;">
				 					<p style="text-transform: uppercase;margin-top: 30px; font-size: 20px;color: #000;"><?php echo $key['name']; ?></p>
				 					<p style="margin-top: 20px; color: #000;font-size: 13px;">x<?php echo $key['amount']; ?></p>
				 					<p style="margin-top: 20px; color: #000;font-size: 13px;">Đặt hàng ngày : <?php echo $key['timeorder']; ?></p>
				 				</div>
				 				<div class="ttkh_ttsp_item_ctsp2" style="width: 50%;float: left;">
				 					<p style="margin-top: 10px; color: #000;font-size: 13px;margin-right: 10px;width: 100%;text-align: right;padding-right: 10px;"><i style="margin-right: 5px;" class="fas fa-shipping-fast"></i>[ Địa chỉ ] <?php echo $key['deliveryaddress']; ?></p>
				 					<p style="margin-top: 30px;color: #000;font-size: 25px;text-align: right; margin-right: 10px;width: 100%;padding-right: 30px;">Tổng tiền:<span style="color: #f23333;"> <?php echo number_format($key['totalmoney']); ?>₫</span></p>
				 					<div class="huy" style="margin-top: 50px;">
				 						<button onclick="removehang(<?php echo $key['idhd']; ?>)" style="">Hủy</button>
				 						<button style="">Chi Tiết Đơn Hàng</button>
				 					</div>
				 				</div>
				 			</div>
				 		</div>
				 	</div>
					<?php
				}
				?>
			 	
			</div>
			<div id="ttkh_vanchuyen" class="city" style="display:none;animation: moveTop 1s ease-out;">
				<?php
				foreach ($dulieu2 as $key) 
				{
					?>
					<div class="ttkh_ttsp_item">
				 		<div class="row">
				 			<div class="col-3">
				 				<div class="ttkh_ttsp_item_img" style="">
				 					<img src="<?php echo $key['avatar']; ?>" style="width: 100%;height: 100%;" alt="">
				 				</div>			 				
				 			</div>
				 			<div class="col-9">
				 				<div class="ttkh_ttsp_item_ctsp" style="width: 50%;float: left;">
				 					<p style="text-transform: uppercase;margin-top: 30px; font-size: 20px;color: #000;"><?php echo $key['name']; ?></p>
				 					<p style="margin-top: 20px; color: #000;font-size: 13px;">x<?php echo $key['amount']; ?></p>
				 					<p style="margin-top: 20px; color: #000;font-size: 13px;">Đặt hàng ngày : <?php echo $key['timeorder']; ?></p>
				 				</div>
				 				<div class="ttkh_ttsp_item_ctsp2" style="width: 50%;float: left;">
				 					<p style="margin-top: 10px; color: #000;font-size: 13px;margin-right: 10px;width: 100%;text-align: right;padding-right: 10px;"><i style="margin-right: 5px;" class="fas fa-shipping-fast"></i>[ Địa chỉ ] <?php echo $key['deliveryaddress']; ?></p>
				 					<p style="margin-top: 30px;color: #000;font-size: 25px;text-align: right; margin-right: 10px;width: 100%;padding-right: 30px;">Tổng tiền:<span style="color: #f23333;"> <?php echo number_format($key['totalmoney']); ?>₫</span></p>
				 					<div class="huy" style="margin-top: 50px;">
				 						
				 						<button style="">Chi Tiết Đơn Hàng</button>
				 					</div>
				 				</div>
				 			</div>
				 		</div>
				 	</div>
					<?php				
				}
				?>
			  	
			</div>

			<div id="ttkh_dagiao" class="city" style="display:none;animation: moveTop 1s ease-out;">
				<?php
				foreach ($dulieu3 as $key)
				{
					?>
					<div class="ttkh_ttsp_item">
				 		<div class="row">
				 			<div class="col-3">
				 				<div class="ttkh_ttsp_item_img" style="">
				 					<img src="<?php echo $key['avatar']; ?>" style="width: 100%;height: 100%;" alt="">
				 				</div>			 				
				 			</div>
				 			<div class="col-9">
				 				<div class="ttkh_ttsp_item_ctsp" style="width: 50%;float: left;">
				 					<p style="text-transform: uppercase;margin-top: 30px; font-size: 20px;color: #000;"><?php echo $key['name']; ?></p>
				 					<p style="margin-top: 20px; color: #000;font-size: 13px;">x<?php echo $key['amount']; ?></p>
				 					<p style="margin-top: 20px; color: #000;font-size: 13px;">Đặt hàng ngày : <?php echo $key['timeorder']; ?></p>
				 				</div>
				 				<div class="ttkh_ttsp_item_ctsp2" style="width: 50%;float: left;">
				 					<p style="margin-top: 10px; color: #000;font-size: 13px;margin-right: 10px;width: 100%;text-align: right;padding-right: 10px;"><i style="margin-right: 5px;" class="fas fa-shipping-fast"></i>[ Địa chỉ ] <?php echo $key['deliveryaddress']; ?></p>
				 					<p style="margin-top: 30px;color: #000;font-size: 25px;text-align: right; margin-right: 10px;width: 100%;padding-right: 30px;">Tổng tiền:<span style="color: #f23333;"> <?php echo number_format($key['totalmoney']); ?>₫</span></p>
				 					<div class="huy" style="margin-top: 50px;">
				 						<button style=""><a href="chitietsanpham.php?idsp=<?php echo $key['idsp']; ?>">Đánh Giá</a></button>
				 						<button style="">Chi Tiết Đơn Hàng</button>
				 					</div>
				 				</div>
				 			</div>
				 		</div>
				 	</div>
					<?php
				}
				?>
			  	
			</div>
		</div>

	</div>
	<?php require_once('footer.php') ?>
</body>
</html>