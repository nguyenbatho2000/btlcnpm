<?php
	include('lib_db.php');
	$id = isset($_SESSION['idkh']) ? $_SESSION['idkh'] : '';
    if(isset($_POST["logout"]))
    {
        unset($_SESSION['idkh']);
        setcookie("username", "", time()-3600);
        setcookie("password", "", time()-3600);
        header("location:Home.php");
    }
    if($id !="")
    {
       $sql1 = "select * from customer_information where id = '$id'";
       $data1 = select_one($sql1);
       $sql2 = "SELECT COUNT(bill.idsp) as sl FROM bill WHERE bill.idkh = $id AND bill.status = 'TrongGio';";
       $datasl = select_one($sql2);
    }
	$khoa = isset($_REQUEST['khoa'])?$_REQUEST['khoa']:"";
	$sql = "select * from product where name like '%$khoa%'";
	$data = select_list($sql);
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Nhạc Cụ Việt</title>
	<link rel="icon" type="images/png" href="img/logo1.ico">  ư
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
		function showbang()
		{
			if (document.getElementById("sapxep").style.display == "none")
			{
				document.getElementById("sapxep").style.display = "block";	
			}
			else
			{
				document.getElementById("sapxep").style.display = "none";	
			}
			
		}
	</script>
	<?php require_once('header.php') ?>
	<div style="clear: both;"></div>
	<div class="container-fluid" style="height: 50px;"></div>
	<div class="container uudai" style="margin-bottom: 50px;padding: 0px;">
   		<div class="title" >
   			<img src="img/piano.png" alt="img/piano.png" width="60" height="60" style="">
   			<h3 style="text-transform: uppercase;"><?php echo $khoa; ?></h3>
   			
   		</div>
   		<div class="sapxeptheo" >
			    <button class="dropdown-toggle" onclick="showbang()" >
			    	Sắp Xếp<span class="caret"></span>
				</button>
			    <ul id="sapxep" style="display: none;">
			    	<a href="">
			    		<li style="border-radius: 5px 5px 0px 0px ;animation: moveBottom 0.5s ease-out;">Tên</li>
			    	</a>
			    	<a href="" >
			    		<li style="animation: moveBottom .7s ease-out;">Giá tăng</li>
			    	</a>
			    	<a href="" >
			    		<li style="animation: moveBottom 1s ease-out;border-radius: 0px 0px 5px 5px ;border-bottom: 1px solid gray">Giá giảm</li>
			    	</a>
			    </ul>
			 </div>
   		<div class="row"style="animation: moveBottom 1s ease-out;width: 100%;">
   			<?php
   			foreach ($data as $key) 
   			{
   			?>
   			<div class="col-lg-3 col-sm-6 col-12" >
   				<a href="chitietsanpham.php?idsp=<?php echo $key['id']; ?>" style="width: 100%;" >
   					<div class="giamgia-box" >
   						<div class="timegiamgia" >
   							<span >1d:2h:06p:32s</span>
   						</div>
   						<div  class="giamgia">
	   						<span style="font-size: 13px;">-20%</span>
	   					</div>
   					</div>
	   				<div class="itemsp" style="width: 100%">
	   					<div class="xemthem" >
	   						<span >Xem Thêm</span>
	   					</div>
	   					<div class="anhsp" >
	   						<img src="<?php echo $key['avatar']; ?>"	 alt="<?php echo $key['avatar'] ?>" style="width: 100% ;height:100%">
	   					</div>

	   					<div class="in4sp">
	   						<div class="tensp">
		   						<span style=""><?php echo $key['name']; ?></span>
		   					</div>
		   					<div class="price">
		   						<span class="giathat" ><?php echo number_format($key['price']); ?></span>
		   						<span class="giagiam" >190.000₫</span>
		   					</div>
	   					</div>
	   				</div>
   				</a>
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