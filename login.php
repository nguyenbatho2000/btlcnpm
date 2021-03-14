
<?php
	session_start();
	include('lib_db.php');
	$erro = "";
	if(isset($_POST['login_btn']))
	{
		$username = $_REQUEST['username'];
		$password = md5($_REQUEST['password']);
		if($username != "" && $password !="")
		{
			$checkusenamepass = "select * from customer_information where username = '$username' and password = '$password'";
			$data = select_one($checkusenamepass);
			if($data != "")
			{
				if ($data['id'] == 1)
					{
						setcookie("username","$username",time()+3600);
						setcookie("password","$password",time()+3600);
						$_SESSION['idkh']=$data['id'];
						header("location:Home.php");	
					}
					else
					{
						setcookie("username","$username",time()+3600);
						setcookie("password","$password",time()+3600);				
						$_SESSION['idkh'] = $data['id'];
						header("location:Home.php");						
					}
			}
			else
			{
				$erro = "Thông tin tài khoản mật khẩu không chính xác";
			}
		}
		else
		{
			$erro = "Bạn chưa nhập đủ thông tin";
		}
	}
	if(isset($_POST['signup']))
	{
		$username = $_REQUEST['username'];
		$password = md5($_REQUEST['password']);
		$fullname = $_REQUEST['fullname'];
		$address = $_REQUEST['address'];
		$numberphone = $_REQUEST['numberphone'];
		$email = $_REQUEST['email'];
		$sex = $_REQUEST['sex'];
		$date = $_REQUEST['date'];
		$repass = md5($_REQUEST['repass']);
		$verify = $_REQUEST['verify'];
		if($username != "" && $password!="" && $fullname!=""&& $address!=""&& $numberphone!="" && $email!="" && $sex!="" && $date!="" && $repass!="")
		{
			if($password == $repass)
			{
				$check = "select * from customer_information where username = '$username'";
				$datacheck = select_one($check);
				if(!isset($datacheck))
				{

					if(md5($verify) == $_REQUEST['mxm'])
					{
						$tablesql = 'customer_information';
						$data['id']="";
						$data['username']=$username;
						$data['password']=$password;
						$data['fullname']=$fullname;
						$data['sex']=$sex;
						$data['date']=$date;
						$data['address']=$address;
						$data['numberphone']=$numberphone;
						$data['email']=$email;
						$insert =  data_to_sql_insert($tablesql,$data);
						exec_update($insert);
						$checkusenamepass = "select * from customer_information where username = '$username' and password = '$password'";
						$data = select_one($checkusenamepass);
						setcookie("username","$username",time()+3600);
						setcookie("password","$password",time()+3600);				
						$_SESSION['idkh'] = $data['id'];
						header("location:Home.php");

					}
					else
					{
						$erro = "Mã xác minh không đúng";
					}	
				}
				else
				{
					$erro = "Tài khoản đã tồn tại";
				}
			}
			else
			{
				$erro = "Mật khẩu nhập lại không chính xác";
			}
		}
		else
		{
			$erro = "Bạn chưa nhập đủ thông tin";
		}
		
	}
	if(isset($_POST['verifyy']))
	{
		$username = $_REQUEST['username'];
		$emailforgot = $_REQUEST['emailforgot'];
		$verifyforgot = $_REQUEST['verifyforgot'];
		$passnew = md5($_REQUEST['passnew']);
		if($username != "" && $emailforgot != "" && $passnew !="")
		{
			if(select_one("select * from customer_information where username = '$username'")!="")
			{
				if(select_one("select * from customer_information where username = '$username'")['email'] == $emailforgot )
				{
					if(md5($verifyforgot) == $_REQUEST['mxm'])
					{
						$tablesql = 'customer_information';						
						$data['password']=$passnew;
						$dkien = "username='".$username."'";
						$update =  data_to_sql_update($tablesql,$data,$dkien);
						exec_update($update);
						$checkusenamepass = "select * from customer_information where username = '$username' and password = '$passnew'";
						$dataa = select_one($checkusenamepass);
						setcookie("username","$username",time()+3600);
						setcookie("password","$passnew",time()+3600);				
						$_SESSION['idkh'] = $dataa['id'];
						header("location:Home.php");
					}
					else
					{
						$erro = "Mã xác minh không chính xác";
					}
				}
				else
				{
					$erro = "Email không chính xác";
				}
			}
			else
			{
				$erro = "Tài khoản không tồn tại";
			}
		}
		else
		{
			$erro = "Bạn chưa nhập đủ thông tin";
		}
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
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <link rel="stylesheet" type="text/css" href="css/header.css">
    <link rel="stylesheet" type="text/css" href="css/footer.css">
</head>
<body>
	<style type="text/css">
		*{
		    margin: 0;
		    padding: 0;
		    box-sizing: border-box;
		}
		#header{height: 65px;background-color: #000;top: 0px;}
		.logo-box{top:5px;}
		.list-box{top:15px}
		.giohang-box{top:15px}
		.search-box{top:15px}
		footer{margin-top: 0px;}
		p{color:#ffc312}
		
	</style>
	<script type="text/javascript">
		function signup()
		{	
			var x = document.getElementById("dangky");
			
			if(x.style.display == "none")	
			{
				document.getElementById("pass").style.display = "block";
				document.getElementById("dangky").style.display = "block";
				document.getElementById("login").style.display = "none";
				document.getElementById("signup").style.display = "block";
				document.getElementById("forgot").style.display = "none";
				document.getElementById("verify").style.display = "none";
				
			}
			else
			{	
				document.getElementById("dangky").style.display = "none";
				document.getElementById("login").style.display = "block";
				document.getElementById("signup").style.display = "none";
				document.getElementById("forgot").style.display = "none";
				document.getElementById("verify").style.display = "none";
				document.getElementById("pass").style.display = "block";	

				
			}
			
			
		}
		function forgot()
		{	
			var x = document.getElementById("forgot");
			
			if(x.style.display == "none")	
			{
				document.getElementById("pass").style.display = "none";
				document.getElementById("forgot").style.display = "block";
				document.getElementById("login").style.display = "none";
				document.getElementById("verify").style.display = "block";
				document.getElementById("dangky").style.display = "none";
				document.getElementById("signup").style.display = "none";

				
			}
			else
			{	
				document.getElementById("pass").style.display = "block";	
				document.getElementById("forgot").style.display = "none";
				document.getElementById("login").style.display = "block";
				document.getElementById("verify").style.display = "none";
				document.getElementById("dangky").style.display = "none";
				document.getElementById("signup").style.display = "none";
				

			}
			
			
		}
		function sendmail()
		{
			var email = document.getElementById('mailforgot').value;
			$.post('backend/sendtomail.php',{'email':email},function(data)
		    { 
		           document.getElementById("mxm").value = data; 
		           console.log(data);
		    });   
		}
		function sendmail1()
		{
			var email = document.getElementById('mailsignup').value;
			$.post('backend/sendtomail.php',{'email':email},function(data)
		    { 
		           document.getElementById("mxm").value = data; 
		           console.log(data);
		    });   
		    document.getElementById('mailsignup').readOnly = 'true';
		}
	</script>
	
	<div style="clear: both;"></div>
	<div class="container" style="">
		<div class="d-flex justify-content-center h-100" style="animation: moveTop 1s ease-out;padding-top: 50px;padding-bottom: 50px;">
			<div class="card">
				<div class="card-header">
					<h3>Sign In</h3>
					<div class="d-flex justify-content-end social_icon" style="animation: moveTop 1s ease-out;">
						<span><i class="fab fa-facebook-square"></i></span>
						<span><i class="fab fa-google-plus-square"></i></span>
						<span><i class="fab fa-twitter-square"></i></span>
					</div>
				</div>
				<div class="card-body">
					<form method="post">
						<div class="input-group form-group">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fas fa-user"></i></span>
							</div>
							<input name="username" type="text" class="form-control" placeholder="Tài Khoản">
						</div>

				<!--aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa-->
						<div id="pass" style="animation: moveTop 1s ease-out;">
							<div class="input-group form-group" >
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fas fa-key"></i></span>
								</div>
								<input name="password" type="password" class="form-control" placeholder="Mật Khẩu">
							</div>
						</div>

				<!--aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa-->
						<div class="signup" id="dangky" style="display: none;transition: 1s;animation: moveBottom 1s ease-out;">
							<div class="input-group form-group singup" id="singup0">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fas fa-user"></i></span>
								</div>
								<input name="fullname" type="text" class="form-control" placeholder="Họ Tên">
							</div>
							<!--aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa-->
							<div class="input-group form-group singup" id="singup1">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fas fa-map-marked-alt"></i></span>
								</div>
								<input name="address" type="text" class="form-control" placeholder="Địa Chỉ">								
							</div>
							<!--aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa-->
							<div class="input-group form-group singup" id="singup2">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fas fa-phone-alt"></i></span>
								</div>
								<input name="numberphone" type="text" class="form-control" placeholder="Số Điện Thoại">
							</div>
							<!--aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa-->
							<div class="input-group form-group singup" id="singup2" style="width: 280px;float: left;margin-right: 10px;">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fas fa-envelope"></i></span>
								</div>
								<input  id="mailsignup" name="email" type="email" class="form-control" placeholder="Email">							
							</div>
							<!--aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa-->
							<div class="input-group form-group" style="width: 65px;margin-right: -10px;">
									<input type="button" onclick="sendmail1()" value="Send" class="btn float-right login_btn">
							</div>
							<!--aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa-->
							<div class="input-group form-group singup" id="singup3" style="width: 150px;float: left;margin-right: 12px;">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fas fa-genderless"></i></span>
								</div>
								<select name="sex" class="form-control" >
									<option value="Nam">Nam</option>
									<option value="Nữ">Nữ</option>
								</select>
							</div>	
							<!--aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa-->
							<div class="input-group form-group singup" id="singup4" style="width: 195px;">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fas fa-table"></i></span>
								</div>
								<input name="date" type="datetime-local" min="2011-08-01" max="2021-08-15" class="form-control" placeholder="Ngày sinh">								
							</div>
							<!--aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa-->
							<div class="input-group form-group singup" id="singup5" style="width: 200px;float: left;margin-right: 10px;">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fas fa-key"></i></span>
								</div>
								<input name="repass" type="password" class="form-control" placeholder="Nhập Lại Mật Khẩu">
							</div>
							<!--aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa-->
							<div class="input-group form-group singup" id="singup6" style="width: 145px;">
								<div class="input-group-prepend" style="width: 40px;">
									<span class="input-group-text"><i class="fas fa-key"></i></span>
								</div>
								<input name="verify" type="text"  class="form-control" placeholder="MXM email">								
							</div>
							<!--aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa-->
						</div>
						<div class="forgot" id="forgot" style="display: none;animation: moveBottom 1s ease-out;">
							
							<div class="input-group form-group singup" id="singup2" style="width: 280px;float: left;margin-right: 10px;">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fas fa-envelope"></i></span>
								</div>
								<input name="emailforgot" type="text" id="mailforgot"  class="form-control" placeholder="Nhâp Email Đã Đăng Ký">								
							</div>
							<div class="input-group form-group" style="width: 65px;margin-right: -10px;">
								<input type="button" onclick="sendmail()" value="Send" class="btn float-right login_btn">
							</div>
						
							<div class="input-group form-group" >
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fas fa-user-check"></i></span>
								</div>
								<input name="verifyforgot" type="text" class="form-control" placeholder="Nhập Mã Xác Nhận">
								
							</div>
							<div class="input-group form-group" >
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fas fa-user-check"></i></span>
								</div>
								<input name="passnew" type="text" class="form-control" placeholder="Nhập mật khẩu mới">
								
							</div>
						</div>
						<div class="row align-items-center remember">
							<input type="checkbox">Remember Me
						</div>
						<div class="form-group">
							<button style="margin-left: 5px;" type="submit" id="login" name="login_btn"  class="btn float-right login_btn">Login</button> 
							<button style="margin-left: 5px; display: none;" type="submit" id="signup" name="signup"  class="btn float-right login_btn">Signup</button> 
							<button style="margin-left: 5px; display: none;" type="submit" id="verify" name="verifyy"  class="btn float-right login_btn">Submit</button> 
							<input type="text" id="mxm" value="" name="mxm" style="display: none;">
							<p style="margin-top: 10px; font-size: 15px;"><?php if($erro != ""){echo '<i style="margin-right: 5px;color: #ff0000" class="fas fa-user-times"></i>'.$erro;} ?></p>
						</div>
					</form>
				</div>
				<div class="d-flex justify-content-center">
						Don't have an account?<p style=""  onclick="signup()" >Sign Up</p>
					</div>
					<div class="d-flex justify-content-center">
						<p onclick="forgot()" >Forgot your password?</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--<?php// require_once('footer.php') ?>-->
</body>
</html>