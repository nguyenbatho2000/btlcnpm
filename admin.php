<?php
	include("lib_db.php"); 
	include("util.php");
    session_start();
    $erro = "";
    $id = isset($_SESSION['idnv']) ? $_SESSION['idnv'] : '';
   	$datausername = "";
    $checkposition = "select * from staff where id_sa = $id ";
    $datacheck = select_one($checkposition);
    if(isset($_POST['logout']))
    {
    	unset($_SESSION['idnv']);
        setcookie("username", "", time()-3600);
        setcookie("password", "", time()-3600);
        header("location:Home.php");
    }
    if ($datacheck != "")
    {
    	if($datacheck['position']=="Admin")
    	{	
    		if(isset($_POST['addnv']))
		    {
		    	
		    	$name_sa = $_REQUEST['name_sa'];
		    	$date_sa =  $_REQUEST['date_sa'];
		    	$sex_sa = $_REQUEST['sex_sa'];
		    	$address_sa = $_REQUEST['address_sa'];
		    	$numberphone_sa = $_REQUEST['numberphone_sa'];
		    	$salary = doubleval($_REQUEST['salary']);
		    	$position = $_REQUEST['position'];
		    	$username_sa = $_REQUEST['username_sa'];
		    	$password_sa = md5($_REQUEST['password_sa']);
		    	if( $name_sa != "" && $date_sa != "" && $sex_sa != "" && $address_sa != "" && $numberphone_sa != "" && $salary !="" && $position != "" && $username_sa != "" && $password_sa != "" && $salary != 0)
		    	{
		    		$datacheckinsert_sa = select_one("select * from staff where username_sa = '$username_sa'");
		    		$datacheckinsert_sa1 = select_one("select * from customer_information where username = '$username_sa'");
		    		if( $datacheckinsert_sa == "" && $datacheckinsert_sa1 == "")
		    		{
			    		$table_sa = "staff";
			    		$data_sa['id_sa'] = "";
			    		$data_sa['name_sa'] = $name_sa;
			    		$data_sa['date_sa'] = $date_sa;
			    		$data_sa['sex_sa'] = $sex_sa;
			    		$data_sa['address_sa'] = $address_sa;
			    		$data_sa['numberphone_sa'] = $numberphone_sa;
			    		$data_sa['salary'] = $salary;
			    		$data_sa['position'] = $position;
			    		$data_sa['username_sa'] = $username_sa;
			    		$data_sa['password_sa'] = $password_sa;
			    		$sqlinsert_sa = data_to_sql_insert($table_sa,$data_sa);
			    		exec_update($sqlinsert_sa);
		    		}
		    		else
		    		{
		    			$erro = "Tài khoản đã tồn tại";
		    		}
		    	}
		    	else
		    	{
		    		$erro = "Bạn chưa nhập đầy đủ thông tin hoặc nhập sai trường dữ liệu";
		    	}
		    	
		    }
    		$dulieu = select_list("select * from staff");
    		foreach ($dulieu as $key) 
    		{
    			if(isset($_POST['bt_'.$key['id_sa']]))
    			{
    				$name_sa_up = $_REQUEST['name_sa'.$key['id_sa']];
			    	$date_sa_up =  $_REQUEST['date_sa'.$key['id_sa']];
			    	$sex_sa_up = $_REQUEST['sex_sa'.$key['id_sa']];
			    	$address_sa_up = $_REQUEST['address_sa'.$key['id_sa']];
			    	$numberphone_sa_up = $_REQUEST['numberphone_sa'.$key['id_sa']];
			    	$salary_up = doubleval($_REQUEST['salary'.$key['id_sa']]);
			    	$position_up = $_REQUEST['position'.$key['id_sa']];
			    	$username_sa_up = $_REQUEST['username_sa'.$key['id_sa']];
			    	$password_sa_up = md5($_REQUEST['password_sa'.$key['id_sa']]);
			    	if( $name_sa_up != "" && $date_sa_up != "" && $sex_sa_up != "" && $address_sa_up != "" && $numberphone_sa_up != "" && $salary_up !="" && $position_up != "" && $username_sa_up != "" && $salary_up != 0)
			    	{
				    		$table_sa_up = "staff";
				    		$where = 'id_sa = '.$key['id_sa'];
				    		$data_sa_up['name_sa'] = $name_sa_up;
				    		$data_sa_up['date_sa'] = $date_sa_up;
				    		$data_sa_up['sex_sa'] = $sex_sa_up;
				    		$data_sa_up['address_sa'] = $address_sa_up;
				    		$data_sa_up['numberphone_sa'] = $numberphone_sa_up;
				    		$data_sa_up['salary'] = $salary_up;
				    		$data_sa_up['position'] = $position_up;
				    		if($password_sa_up != "")
				    		{
				    			$data_sa_up['password_sa'] = $password_sa_up;
				    		}
				    		
				    		$sqlinsert_sa_up = data_to_sql_update($table_sa_up,$data_sa_up,$where);
				    		exec_update($sqlinsert_sa_up);
			  
			    	}
			    	else
			    	{
			    		$erro = "Bạn chưa nhập đầy đủ thông tin hoặc nhập sai trường dữ liệu";
			    	}
    			}
    		}
    	}
    	else
    	{
    		if(isset($_POST['changepass']))
    		{
    			$passwordold = md5($_REQUEST['passwordold']);
    			$passwordnew = md5($_REQUEST['passwordnew']);
    			$repasswordnew = md5($_REQUEST['repasswordnew']);
    			if($passwordold != "" && $passwordnew != "" && $repasswordnew != "")
    			{
    				if($passwordold == $datacheck['password_sa'])
    				{
    					if($passwordnew == $repasswordnew)
    					{
    						$updatepass = "update staff set password_sa = '$passwordnew' where id_sa = $id";
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
    		if(isset($_POST['product_add']))
		    {
		    	$add['id'] = "";
				$add['name'] = $_REQUEST['product_name'];
				$add['avatar'] = upload_file_by_name("product_imgg");
				$add['price'] = $_REQUEST['product_price'];
				$add['total'] = $_REQUEST['product_total'];
				$add['description'] = $_REQUEST['product_description'];
				$add['detail'] = $_REQUEST['product_detail'];
				$add['category'] = $_REQUEST['product_category'];    	
	    		$table = "product";
	    		$truyvan = data_to_sql_insert($table,$add); 
	    		exec_update($truyvan);
		    }
    		$dulieu = select_list("select * from product");
    		foreach ($dulieu as $key) 
    		{
    			if(isset($_POST['editsanpham'.$key['id']]))
    			{
    				$dk = 'id = '.$key['id'];
    				$edit['name'] = $_REQUEST['product_name'.$key['id']];
    				$anh = $_FILES['product_img'.$key['id']];
    				if($anh['name'] != "")
    				{
    					$edit['avatar'] = upload_file_by_name("product_img".$key['id']);
    				}
    				$edit['price'] = $_REQUEST['product_price'.$key['id']];
    				$edit['total'] = $_REQUEST['product_total'.$key['id']];
    				$edit['description'] = $_REQUEST['product_description'.$key['id']];
    				$edit['detail'] = $_REQUEST['product_detail'.$key['id']];
    				$edit['category'] = $_REQUEST['product_category'.$key['id']];
    				$bang = "product";
    				exec_update(data_to_sql_update($bang,$edit,$dk));
    				
    			}
    		}
    	}
    }
    else
    {
    	header('location:Home.php');
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
    <link rel="stylesheet" type="text/css" href="css/sanpham.css">
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <link href="http://fonts.googleapis.com/css?family=Dynalight" rel="stylesheet" type="text/css">
</head>
<body style="background-image: linear-gradient(to right bottom, rgba(69 69 69 / 80%),rgba(7 7 7 / 80%)),url('img/backgroundadmin.jpg');">
	<style type="text/css">
		@keyframes cuonn{
			0%{
				max-height: 0;
			}
			100%{
				max-height: 1;
			}
		}
		@keyframes zoomout {
		    0%{
		        transform: scale(0,0);
		    }
		    100%{
		        transform: scale(1,1);
		    }
		}

		@keyframes moveInRight {
		    0% {
		        opacity: 0;
		        transform: translateX(100px);
		    }

		    80% {
		        transform: translateX(-10px)
		    }

		    100% {
		        opacity: 1;
		        transform: translateX(0);
		    }
		}

		@keyframes moveInLeft {
		    0% {
		        opacity: 0;
		        transform: translateX(-100px);
		    }

		    80% {
		        transform: translateX(10px)
		    }

		    100% {
		        opacity: 1;
		        transform: translateX(0);
		    }
		}
		@keyframes moveTop {
		    0% {
		        opacity: 0;
		        transform: translateY(-30px);
		    }

		    100% {
		        opacity: 1;
		        transform: translateY(0px);
		    }
		}
		@keyframes moveBottom {
		    0% {
		        opacity: 0;
		        transform: translateY(30px);
		    }

		    100% {
		        opacity: 1;
		        transform: translateY(0px);
		    }
		}

		.neon 
		{   
		-webkit-box-sizing: border-box;  
		-moz-box-sizing: border-box;  
		box-sizing: border-box;  
		padding: 0px;  
		border: none;  
		
		color: rgba(255,255,255,1);  
		text-decoration: normal;  
		text-align: center;  
		-o-text-overflow: clip;  
		text-overflow: clip;  
		white-space: pre;  
		text-shadow: 0 0 10px rgba(255,255,255,1) , 0 0 20px rgba(255,255,255,1) , 0 0 30px rgba(255,255,255,1) , 0 0 40px #ff00de , 0 0 70px #ff00de , 0 0 80px #ff00de , 0 0 100px #ff00de ;  
		-webkit-transition: all 200ms cubic-bezier(0.42, 0, 0.58, 1);  
		-moz-transition: all 200ms cubic-bezier(0.42, 0, 0.58, 1);  
		-o-transition: all 200ms cubic-bezier(0.42, 0, 0.58, 1);  
		transition: all 200ms cubic-bezier(0.42, 0, 0.58, 1);
		}
 
		.neon:hover 
		{  
		text-shadow: 0 0 10px rgba(255,255,255,1) , 0 0 20px rgba(255,255,255,1) , 0 0 30px rgba(255,255,255,1) , 0 0 40px #00ffff , 0 0 70px #00ffff , 0 0 80px #00ffff , 0 0 100px #00ffff ;
		}
		body 
		{
		background-color:#000000
		}
 
		.admin_box
		{
			height:600px;
			background-color: #00000082;
			border-radius: 5px;
		}
		.admin_box ul li{
			width: 100%;
			padding: 15px;
			border: 1px solid black;
			margin-top: 1px;
			border-radius: 5px;
			transition: 0.5s;
		}
		.admin_box ul li a{
			color: #fff;
			font-size: 13px;
			padding: 20px;

		}
		.admin_box ul li:hover{
			background-color: #feaf377a;
			box-shadow: 0px 0px 5px 1px #feaf37;
			transform: translateY(-3px);
		}
		.admin_box h2{
			font-size: 15px;
			padding: 20px;
			text-align: center;
			margin-top: 10px;
			color: #fff;
			background-color: #00000082;
			padding-top: 25px;
			padding-bottom: 25px;
		}
		.admin_iteam{
			margin-top: 10px;
			height:600px;
			background-color: #00000082;
			border-radius: 5px;
		}
		.admin_iteam_header
		{
			background-color: #00000082;
			width: 100%;
			height: 70px;
		}
		.active{
			background-color: #feaf377a;
			box-shadow: 0px 0px 5px 1px #feaf37;
			transform: translateY(-3px);
		}
		.admin_iteam_boddy{

			width: 100%;
			margin-top: 20px;
		}
		.admin_iteam_add{
			width: 98%;
			margin: auto;
			height: 500px;
			background-color: #fff;
			border-radius: 10px;
			border: 1px solid black;
			overflow: auto;
			clip-path: polygon(15% 0, 18% 12%, 100% 12%, 100% 100%, 0 100%, 0 0);
		}
		.admin_iteam_add h2{
			font-family: "Lato", sans-serif;
			font-size: 20px;
			color: #000;
			margin-top: 5px;
			margin-left: 10px;
			font-weight: bold;
			box-shadow: 2px 0px 5px 3px gray; 
			padding-left: 10px;
			padding-top: 10px;
			padding-bottom: 5px;
		}
		button:hover{
			background-color: #FFC312!important;
		}
	</style>
	<script type="text/javascript">
		function editsanpham(idsp)
		{
			$.post('backend/editsanpham.php',{'idsp':idsp},function(data){
				document.getElementById('editsp').style.display = "block";
				document.getElementById('editsp').innerHTML = data;
			});
		}
		function deletenhanvien(idsp)
		{
			var option = confirm("Bạn có muốn xóa không?");
			if(option == true)
			{
				
				$.post('backend/deletesanpham.php',{'idsp':idsp},function(data){location.reload();});
			}
			
		}
		function editnhanvien(userid)
		{
			$.post('backend/editnhanvien.php',{'userid':userid},function(data){
				document.getElementById('edit').style.display = "block";
				document.getElementById('edit').innerHTML = data;
			});
		}
		function staffinformation(userid)
		{
			$.post('backend/staffinformation.php',{'userid':userid},function(data){
				document.getElementById('staffinformation').style.display = "block";
				document.getElementById('staffinformation').innerHTML = data;
			});
		}
		function deletenhanvien(userid)
		{
			var option = confirm("Bạn có muốn xóa nhân viên này không?");
			if(option == true)
			{
				
				$.post('backend/deletenhanvien.php',{'userid':userid},function(data){location.reload();});
			}
			
		}
		function changepass()
		{
			
			document.getElementById('changepass').style.display = "block";
				
		}
		function closechangepass()
		{
			document.getElementById('changepass').style.display = "none";
		}
		function closeinfor()
		{
			document.getElementById('staffinformation').innerHTML = "";
			document.getElementById('staffinformation').style.display = "none";
		}
		function closeedit()
		{
			document.getElementById('edit').innerHTML = "";
			document.getElementById('edit').style.display = "none";
			
		}
		function closeeditsp()
		{
			document.getElementById('editsp').innerHTML = "";
			document.getElementById('editsp').style.display = "none";
		}
		function timkiemnhanvien(value)
		{
			$.post('backend/timkiemnhanvien.php',{'value':value},function(data){document.getElementById('tablenv').innerHTML = data;});
		}
			
		function hienanh()
		{
			var file = document.getElementById("product_img_file").files[0];
			if (file)
			{
				var reader = new FileReader();
				reader.addEventListener("load",function(){
					document.getElementById("product_img").setAttribute("src",this.result);

				});
				reader.readAsDataURL(file);
			}

		};
		function hienanh2(id,img)
		{
			var file = document.getElementById(id).files[0];
			if (file)
			{
				var reader = new FileReader();
				reader.addEventListener("load",function(){
					document.getElementById(img).setAttribute("src",this.result);

				});
				reader.readAsDataURL(file);
			}

		};
		function showqlnv()
		{
			document.getElementById("addsaff").style.display = "block";
			document.getElementById("table_addsaff").style.display = "block";
			document.getElementById("checkthongke").style.display = "none";
			document.getElementById("style").style.display = "none";
		}
		function showtt()
		{
			document.getElementById("addsaff").style.display = "none";
			document.getElementById("table_addsaff").style.display = "none";
			document.getElementById("checkthongke").style.display = "block";
			document.getElementById("style").style.display = "block";
		}
		function checkradio()
		{
			document.getElementById("radiongay").checked = true;
			document.getElementById("radiothang").checked = false;
		}
		function checkradio2()
		{
			document.getElementById("radiongay").checked = false;
			document.getElementById("radiothang").checked = true;
		}
		function thongke()
		{
			if(document.getElementById("radiongay").checked == true)
			{
				var date = document.getElementById("datengay").value;
				if(date != "")
				{
					$.post('backend/thongke.php',{'date':date},function(data)
					{ 
						document.getElementById("tongtienthongke").innerHTML = data+"₫";
					});
					
				}
				else
				{
					alert("Mời bạn chọn ngày cần thống kê");
				}
			}
			else if(document.getElementById("radiothang").checked == true)
			{
				var date = document.getElementById("datethang").value;
				if(date != "")
				{
					$.post('backend/thongke.php',{'date1':date},function(data)
					{ 
						document.getElementById("tongtienthongke").innerHTML = data+"₫";
					});
					
				}
				else
				{
					alert("Mời bạn chọn ngày cần thống kê");
				}
			}
			else
			{
				alert("Mời bạn chọn dặc điểm thống kê");
			}
		}
	</script>
	<?php 
		if($erro != "")
		{
			?>
			<script type="text/javascript">
				alert("<?php echo $erro ?>");
			</script>
			<?php
		}
	?>
	<?php 
	if($datacheck['position'] == "Admin")
	{
		?>
		<div class="edit" id="edit" style="position: fixed;top: 8%;left: 32%;z-index: 1000; display: none;">
			
		</div>
		<?php
	}

	else
	{
		?>
		<div class="edit" id="changepass" style="position: fixed;top: 25%;left: 32%;z-index: 1000; display: none;">
			<div style="width: 500px;background-color: #000000c7;border-radius: 10px;box-shadow: 0px 0px 10px 6px #feaf377a;animation: zoomout 1s ease-out;">
				<div class="container" style="padding-top: 40px;padding-bottom: 40px;padding-left: 50px;padding-right: 50px;">
					<form method="post">
						<div class="input-group form-group">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fas fa-user"></i></span>
							</div>
							<input type="password" name="passwordold" class="form-control" placeholder="Enter Old Password">
						</div>
						<!--/////////////////////////////////////////////////////////////////////////-->
						<div class="input-group form-group">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fas fa-table"></i></span>
							</div>
							<input type="text" name="passwordnew" class="form-control" placeholder="Enter New Password">
						</div>
						<!--/////////////////////////////////////////////////////////////////////////-->
						<div class="input-group form-group">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fas fa-genderless"></i></span>
							</div>
							<input type="password" name="repasswordnew" class="form-control" placeholder="Enter New Repassword">
						</div>
						<!--/////////////////////////////////////////////////////////////////////////-->
						<div class="input-group form-group">
							<button type="submit"  name="changepass" class="btn login_btn" style="margin-left: 10px;">Change</button>
							<button type="button" onclick="closechangepass()" class="btn login_btn" style="margin-left: 10px;"><i style="margin-right: 3px;" class="fas fa-sign-out-alt"></i>Out</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<div class="edit" id="staffinformation" style="position: fixed;top: 8%;left: 32%;z-index: 1000; display: none;">
			
		</div>
		<div id="editsp" style="position: fixed;z-index: 1000; display: none;top: 15%;left: 15%;">
			
		</div>
		<?php
	}
	?>
	<div class="container-fluid" style="">
		<div class="row" style="width: 100%;">
			<div class="col-2">
				<div class="admin_box" >
					<h2>Admin</h2>
					<ul style="margin-top: -5px;">	
						<?php 
						if($datacheck['position'] == "Admin")
						{
						?>
						<li class=""><a onclick="showqlnv()" class="" href="#" style="">Quản Lý Nhân viên</a></li>
						<li ><a  onclick="showtt()" class="" href="#" style="">Thống Kê DT</a></li>
						<?php
						}
						else
						{
						?>
						<li ><a class="" href="" style="">Quản Lý Sản Phẩm</a></li>
						<?php
						}
						?>
					</ul>
				</div>
			</div>
			<div class="col-10">
				<?php 
				if($datacheck['position'] == "Admin")
				{
				?>
					<div class="admin_iteam" style="">
						<div class="admin_iteam_header">
							<form method="post">
								<div class="form-group" style="height: 50px;margin-right: 10px;float: right;margin-top: 15px;">
									<button style="margin-left: 5px;color: #000;font-family: 'Lato';" type="submit" name="logout"  class="btn float-right login_btn"><i class="fas fa-sign-out-alt"></i>Logout</button> 
								</div>
							</form>								
						</div>
						<div class="admin_iteam_boddy"  id="addsaff">
							
							<div class="admin_iteam_add">
								<h2><i class="fas fa-user-plus"></i>Add</h2>
								<div class="container" style="margin-top: 40px;">
									<form method="post">
										<div class="input-group form-group">
											<div class="input-group-prepend">
												<span class="input-group-text"><i class="fas fa-user"></i></span>
											</div>
											<input name="name_sa" type="text" class="form-control" placeholder="Name">
										</div>
										<!--/////////////////////////////////////////////////////////////////////////-->
										<div class="input-group form-group">
											<div class="input-group-prepend">
												<span class="input-group-text"><i class="fas fa-table"></i></span>
											</div>
											<input name="date_sa" type="datetime-local" class="form-control" placeholder= "Date">
										</div>
										<!--/////////////////////////////////////////////////////////////////////////-->
										<div class="input-group form-group">
											<div class="input-group-prepend">
												<span class="input-group-text"><i class="fas fa-genderless"></i></span>
											</div>
											<select name="sex_sa" class="form-control">
												<option value="Nam">Nam</option>
												<option value="Nữ">Nữ</option>
											</select>
										</div>
										<!--/////////////////////////////////////////////////////////////////////////-->
										<div class="input-group form-group">
											<div class="input-group-prepend">
												<span class="input-group-text"><i class="fas fa-map-marked-alt"></i></span>
											</div>
											<input name="address_sa" type="text" class="form-control" placeholder="Address">
										</div>
										<!--/////////////////////////////////////////////////////////////////////////-->
										<div class="input-group form-group">
											<div class="input-group-prepend">
												<span class="input-group-text"><i class="fas fa-phone-alt"></i></span>
											</div>
											<input name="numberphone_sa" type="text" class="form-control" placeholder="Number Phone">
										</div>
										<!--/////////////////////////////////////////////////////////////////////////-->
										<div class="input-group form-group">
											<div class="input-group-prepend">
												<span class="input-group-text"><i class="fas fa-money-check-alt"></i></span>
											</div>
											<input name="salary" type="text" class="form-control" placeholder="Salary">
										</div>
										<!--/////////////////////////////////////////////////////////////////////////-->
										<div class="input-group form-group">
											<div class="input-group-prepend">
												<span class="input-group-text"><i class="fas fa-user"></i></span>
											</div>
											<select name="position" class="form-control">
												<option value="Admin">Admin</option>
												<option value="Quản Lý SP">Quản Lý SP</option>
												<option value="NV Giao Hàng">NV Giao Hàng</option>
											</select>
										</div>
										<!--/////////////////////////////////////////////////////////////////////////-->
										<div class="input-group form-group">
											<div class="input-group-prepend">
												<span class="input-group-text"><i class="fas fa-user"></i></span>
											</div>
											<input name="username_sa" type="text" class="form-control" placeholder="Username">
										</div>
										<!--/////////////////////////////////////////////////////////////////////////-->
										<div class="input-group form-group">
											<div class="input-group-prepend">
												<span class="input-group-text"><i class="fas fa-key"></i></span>
											</div>
											<input name="password_sa" type="text" class="form-control" placeholder="Password">
										</div>
										<!--/////////////////////////////////////////////////////////////////////////-->
										<div class="form-group" style="height: 50px;margin-top: 50px;margin-right: 10px;">
											<button style="margin-left: 5px;color: #000;font-family: 'Lato';float: left;" type="submit" name="addnv"  class="btn float-right login_btn"><i class="fas fa-user-plus"></i>Add</button> 
										</div>
									</form>
								</div>	
							</div>
						</div>

						<div class="admin_iteam_boddy" style="display: none;" id="checkthongke">
							<div class="admin_iteam_add">
								<h2><i style="color: #FFC312;margin-right: 3px;" class="fas fa-chart-pie"></i>Thống Kê</h2>
								<form method="post">
									<div style="width: 100%;margin-top: 30px;">
										<div class="input-group form-group" style="width: 400px;float: left;margin-bottom: 30px;">
											<input onclick="checkradio()" id="radiongay" type="radio" name="" style="margin-left: 20px;margin-right: 20px;margin-top: 10px;">
											<label style="margin-right: 20px;margin-top: 3px;">Theo Ngày</label>
											<input id="datengay" class="form-control"  type="datetime-local">
										</div>
										<div class="input-group form-group" style="width: 400px;float: left;margin-left: 100px;margin-bottom: 30px;">
											<input onclick="checkradio2()" id="radiothang" type="radio" name="" style="margin-left: 20px;margin-right: 20px;margin-top: 10px;">
											<label style="margin-right: 20px;margin-top: 3px;">Theo Tháng</label>
											<input id="datethang" class="form-control"  type="datetime-local">
										</div>
									</div>
									<div class="input-group form-group" style="width: 400px;">
										<button onclick="thongke()" style="margin-left: 20px;color: #000;font-family: 'Lato';float: left;width: 200px;" type="button"class="btn float-right login_btn"><i style="margin-right: 10px;" class="fas fa-chart-line"></i>Thống Kê</button> 
									</div>
									<div class="table" style="width: 90%;left: 5%;border-bottom: 1px solid black;position: absolute;bottom: 50px;">
										<label style="float: left;font-size: 18px;margin-left: 30px;color: black;">Tổng doanh thu</label>
										<label style="float: right;margin-right: 20px;font-size: 18px;color: #f23333" id="tongtienthongke"></label>
									</div>
								</form>
							</div>
						</div>
					</div>
				<?php
				}
				else
				{
					?>
					<div class="admin_iteam" style="">
						<div class="admin_iteam_header">
							<form method="post">
								<div class="form-group" style="height: 50px;margin-right: 10px;float: right;margin-top: 15px;">
									<button style="margin-left: 5px;color: #000;font-family: 'Lato';" type="submit" name="logout"  class="btn float-right login_btn"><i class="fas fa-sign-out-alt"></i>Logout</button> 
								</div>
								<div class="form-group" style="height: 50px;margin-right: 10px;float: right;margin-top: 15px;">
									<button style="margin-left: 5px;color: #000;font-family: 'Lato';" type="button" onclick="staffinformation(<?php echo $datacheck['id_sa']; ?>)"  class="btn float-right login_btn"><i style="margin-right: 3px; " class="fas fa-user"></i><?php echo $datacheck['name_sa']; ?></button> 
								</div>
								<div class="form-group" style="height: 50px;margin-right: 10px;float: right;margin-top: 15px;">
									<button style="margin-left: 5px;color: #000;font-family: 'Lato';width: 110px;" type="button" onclick="changepass()"  class="btn float-right login_btn">Change Pass</button> 
								</div>
							</form>
						</div>
						<div class="admin_iteam_boddy">
							<div class="" style="height: 10px;"></div>
							<div class="admin_iteam_add" style="height: 100%;">
								<h2><i class="fas fa-user-plus"></i>Add</h2>
								<div class="container" style="margin-top: 40px;">
									<form method="post" enctype="multipart/form-data">
										<div class="row">
											<div class="col-3">
												<div class="product_img" style="width: 150px;height: 150px;margin: auto;border: 1px solid black;">
													<img  id="product_img" src="" style="width: 100%;height: 100%;">
													<label id="img" style="position: absolute;z-index: 1000;top: 122px;left: 57px;background-color: #00000082;color: #fff;padding-left: 35px;padding-right: 34px; " for="product_img_file">Upload img</label>
													<input type="file" onchange="hienanh()"  name="product_imgg" id="product_img_file" style="display: none;">
												</div>
											</div>
											<div class="col-9">
												
													<div class="input-group form-group" style="width: 300px;float: left;">
														<div class="input-group-prepend">
															<span class="input-group-text" style="width: 100px;font-size: 13px;"><i style="padding-right:5px; " class="fas fa-user"></i>Name</span>
														</div>
														<input name="product_name" type="text" class="form-control" placeholder="Product Name">
													</div>
													<div class="input-group form-group" style="width: 400px;padding-left: 30px;">
														<div class="input-group-prepend">
															<span class="input-group-text" style="width: 100px;font-size: 13px;"><i style="padding-right:5px; " class="fas fa-user"></i>Price</span>
														</div>
														<input name="product_price" type="text" class="form-control" placeholder="Product Price">
													</div>
													<div class="input-group form-group" style="width: 300px;float: left;">
														<div class="input-group-prepend">
															<span class="input-group-text" style="width: 100px;font-size: 13px;"><i style="padding-right:5px; " class="fas fa-user"></i>Total</span>
														</div>
														<input name="product_total" type="text" class="form-control" placeholder="Product Total">
													</div>
													<div class="input-group form-group" style="width: 400px;padding-left: 30px;">
														<div class="input-group-prepend">
															<span class="input-group-text" style="width: 100px;font-size: 13px;"><i style="padding-right:5px; " class="fas fa-user"></i>Category</span>
														</div>
														<select  name="product_category" class="form-control">
															<option value="Piano">Piano</option>
															<option value="Sao">Sáo</option>
															<option value="Organ">Organ</option>
															<option value="Violin">Violin</option>
															<option value="Guitar">Guitar</option>
															<option value="Saxophone">Saxophone</option>
															<option value="Trong">Trống</option>
														</select>
													</div>
													<div class="input-group form-group" style="">
														<div class="input-group-prepend">
															<span class="input-group-text" style="width: 100px;font-size: 13px;"><i style="padding-right:5px; " class="fas fa-user"></i>Description</span>
														</div>
														<input name="product_description" type="text" class="form-control" placeholder="Product Description">
													</div>
													<div class="input-group form-group" style="">
														<div class="input-group-prepend">
															<span class="input-group-text" style="width: 100px;font-size: 13px;"><i style="padding-right:5px; " class="fas fa-user"></i>Detail</span>
														</div>
														<textarea style="min-height: 70px;max-height: 140px;" name="product_detail" class="form-control" placeholder="Product Detail"></textarea>
													</div>
													<div class="form-group" style="height: 50px;margin-top: 10px;margin-right: 10px;">
														<button style="margin-left: 5px;color: #000;font-family: 'Lato';float: left;" type="submit" name="product_add"  class="btn float-right login_btn"><i class="fas fa-user-plus"></i>Add</button> 
													</div>
												
											</div>
										</div>
									</form>
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
	<div class="container-fluid" id="style" style="height: 100px;display: none;"></div>
	<?php 
	if($datacheck['position'] == "Admin")
	{
		$selectid = select_list("select * from staff");
		?>
		<div class="container-fluid" style="margin-top: 50px;padding-bottom: 50px;" id="table_addsaff">
			<table class="table table-sm table-dark" style="background-color: #00000082;overflow: auto;">
			  <thead>
			  	<!-- <tr>
			      <th scope="col"><input onkeyup="timkiemnhanvien(this.value)" type="text" name="" class="form-control"></th>
			      <th scope="col"><button class="btn login_btn"><i style="margin-right: 3px;" class="fas fa-search-plus"></i>Search</button></th>
			    </tr> -->
			    <tr>
				    <th scope="col"><i style="margin-right: 3px;" class="fas fa-user-circle"></i>id</th>
				    <th scope="col"><i style="margin-right: 3px;" class="fas fa-user-circle"></i>Name</th>
			        <th scope="col"><i style="margin-right: 3px;" class="fas fa-user-circle"></i>Date</th>
			        <th scope="col"><i style="margin-right: 3px;" class="fas fa-user-circle"></i>Sex</th>
			        <th scope="col"><i style="margin-right: 3px;" class="fas fa-user-circle"></i>Address</th>
			        <th scope="col"><i style="margin-right: 3px;" class="fas fa-user-circle"></i>Phone</th>
			        <th scope="col"><i style="margin-right: 3px;" class="fas fa-user-circle"></i>Salary</th>
			        <th scope="col"><i style="margin-right: 3px;" class="fas fa-user-circle"></i>Position</th>
			      	<th scope="col"><i style="margin-right: 3px;" class="fas fa-user-circle"></i>User</th>
				    <th scope="col"><i style="margin-right: 3px;" class="fas fa-edit"></i>Edit</th>
				    <th scope="col"><i style="margin-right: 3px;" class="fas fa-trash-alt"></i>Delete</th>
			    </tr>
			  </thead>
			  <tbody id="tablenv" style="">
			  	<?php
			  	foreach ($selectid as $key) 
			  	{
			  		
			  	?>
			  	<tr style="">
			    	<form method="post">
				      	<td><?php echo $key['id_sa']; ?></td>
				      	<td><?php echo $key['name_sa']; ?></td>
				      	<td><?php echo $key['date_sa']; ?></td>
				      	<td><?php echo $key['sex_sa']; ?></td>
				      	<td style="text-overflow: hide;overflow: hidden;"><?php echo $key['address_sa']; ?></td>
				      	<td><?php echo $key['numberphone_sa']; ?></td>
				      	<td><?php echo number_format($key['salary']); ?></td>
				      	<td><?php echo $key['position']; ?></td>
				      	<td><?php echo $key['username_sa']; ?></td>
				      	<td><button type="button" onclick="editnhanvien('<?php echo $key['id_sa']; ?>')" class="btn login_btn"><i style="margin-right: 3px;" class="far fa-edit"></i>Edit</button></td>
				      	<td><button type="button" onclick="deletenhanvien('<?php echo $key['id_sa']; ?>')" class="btn login_btn"><i style="margin-right: 3px;" class="far fa-trash-alt"></i>Delete</button></td>
				    </form>
			    </tr>
			  	<?php
			  	}
			  	?>
			  </tbody>
			</table>
		</div>
		<?php
	}
	else
	{
		$selectid = select_list("select * from product");
		?>
		<script type="text/javascript">
			function editsanpham(idsp)
			{
				$.post('backend/editsanpham.php',{'idsp':idsp},function(data){
					document.getElementById('editsp').style.display = "block";
					document.getElementById('editsp').innerHTML = data;
				});
			}
			function deletesanpham(idsp)
			{
				var option = confirm("Bạn có muốn xóa không?");
				if(option == true)
				{
					
					$.post('backend/deletesanpham.php',{'idsp':idsp},function(data){location.reload();});
				}
			}
		</script>
		<div class="container" style="max-width: 98%;margin: auto;margin-top: 50px;padding-bottom: 50px;">
			<table class="table table-sm table-dark" style="background-color: #00000082;">
			  <thead>
			    <tr>
			      <th scope="col"><i style="margin-right: 3px;" class="fas fa-fingerprint"></i>Id</th>
			      <th scope="col"><i style="margin-right: 3px;" class="fas fa-user-alt"></i>Name</th>
			      <th scope="col"><i style="margin-right: 3px;" class="fas fa-images"></i>Image</th>
			      <th scope="col"><i style="margin-right: 3px;" class="fas fa-hand-holding-usd"></i>Price</th>
			      <th scope="col"><i style="margin-right: 3px;" class="fas fa-sort-numeric-up-alt"></i>Total</th>
			      <th scope="col"><i style="margin-right: 3px;" class="fas fa-pen"></i>Description</th>
			      <th scope="col"><i style="margin-right: 3px;" class="fas fa-info-circle"></i>Detail</th>
			      <th scope="col"><i style="margin-right: 3px;" class="fas fa-dumpster"></i>Category</th>
			      <th scope="col"><i style="margin-right: 3px;" class="fas fa-edit"></i>Edit</th>
			      <th scope="col"><i style="margin-right: 3px;" class="fas fa-trash-alt"></i>Delete</th>
			    </tr>
			  </thead>
			  <tbody id="tablenv" style="">
			  	<?php
			  	foreach ($selectid as $key) 
			  	{			  		
			  	?>
			  	<tr style="width: 100%;">
			    	<form method="post">
				      	<td><?php echo $key['id']; ?></td>
				      	<td><?php echo $key['name']; ?></td>
				      	<td><img src="<?php echo $key['avatar']; ?>" style="width: 50px;height: 50px;"></td>
				      	<td><?php echo $key['price']; ?></td>
				      	<td><?php echo $key['total']; ?></td>
				      	<td style="text-overflow: ellipsis;overflow: hidden;white-space: nowrap; max-width: 180px;"><?php echo $key['description']; ?></td>
				      	<td style="text-overflow: ellipsis;overflow: hidden;white-space: nowrap; max-width: 400px;"><?php echo $key['detail']; ?></td>
				      	<td><?php echo $key['category']; ?></td>
				      	<td><button type="button" onclick="editsanpham('<?php echo $key['id']; ?>')" class="btn login_btn"><i style="margin-right: 3px;" class="far fa-edit"></i>Edit</button></td>
				      	<td><button type="button" onclick="deletesanpham(<?php echo $key['id']; ?>)" class="btn login_btn"><i style="margin-right: 3px;" class="far fa-trash-alt"></i>Delete</button></td>
				    </form>
			    </tr>
			  	<?php
			  	}
			  	?>
			  </tbody>
			</table>
		</div>
		<?php
	}
	?>
</body>
</html>