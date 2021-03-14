<?php
	include("lib_db.php"); 
    session_start();
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
    if(isset($_COOKIE['usname']))
    {      
        if(isset($_COOKIE['pass']))
        {
            $tk = $_COOKIE['usname'];
            $mk = $_COOKIE['pass'];
            $sql = "";
            $data = select_one($sql);

            if ($data !=0)
            {
                $id = $data['id'];
                if ($id == 1)
                {
                     $_SESSION['idkh']=$id;
                }
                else
                {           
                    
                    $_SESSION['idkh']=$id;                        
                }
            }
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
    <link rel="stylesheet" type="text/css" href="css/Home.css">
    <link rel="stylesheet" type="text/css" href="css/header.css">
    <link rel="stylesheet" type="text/css" href="css/footer.css">
</head>
<body style="">
	<script type="text/javascript">
		window.onscroll = function ()
		{
				
			if (document.body.scrollTop > 10 || document.documentElement.scrollTop >10)
			{
				console.info(document.documentElement.scrollTop);
				document.getElementById("header").style.background = "black";
				document.getElementById("logo-box").style.top = '5px';
				document.getElementById("list-box").style.top = '15px';
				document.getElementById("giohang-box").style.top = '15px';
				document.getElementById("search-box").style.top = '15px';
				if(document.body.scrollTop > 500 || document.documentElement.scrollTop >500)
				{
					
				}

			} 
			else
			{
				document.getElementById("header").style.background = "transparent";
				document.getElementById("logo-box").style.top = '20px';
				document.getElementById("list-box").style.top = '30px';
				document.getElementById("giohang-box").style.top = '30px';
				document.getElementById("search-box").style.top = '30px';
			}
		};
	</script>
	<?php require_once("header.php") ?>
	<header id="hed" style="position: relative;">
		<div class="container-fluid containerr">
			<div class="bird-container bird-container_mot">
				<div class="bird bird_mot"></div>
			</div>
			
			<div class="bird-container bird-container_hai">
				<div class="bird bird_hai"></div>
			</div>
			
			<div class="bird-container bird-container_ba">
				<div class="bird bird_ba"></div>
			</div>
			
			<div class="bird-container bird-container_bon">
				<div class="bird bird_bon"></div>
			</div>	
		</div>
		<div class="container-fluid containerr" style="margin-top: -50px;">
			<div class="bird-container bird-container_mot" style="margin-left: -50px; ">
				<div class="bird bird_mot" style=""></div>
			</div>
			
			<div class="bird-container bird-container_hai" style="margin-left: -150px; ">
				<div class="bird bird_hai"></div>
			</div>
			
			<div class="bird-container bird-container_ba" style="margin-left: -100px; ">
				<div class="bird bird_ba"></div>
			</div>
			
			<div class="bird-container bird-container_bon" style="margin-left: -70px; ">
				<div class="bird bird_bon"></div>
			</div>	
		</div>
        <div class="text-box">
            <h3 class="heading-primary">
                <span class="heading-primary__main">
                    nhaccuviet
                </span>
                <span class="heading-primary__sub">
                    is how you survive
                </span>
            </h3>
        </div>
    </header>
   	<div class="container" style="margin-top: 10px;">		
		<div class="iteam" style="">
			<a class="theloai" href="sanpham.php?theloai=Piano&page=1&sapxep=" style="">
				<div class="imgg" style="">
					<img src="img/banner/biapiano.jpg" style="" >
					
					<p  style="width: 100%;">Piano</p>
					
				</div>				
			</a>
		</div>
		<div class="iteam" style="">
			<a class="theloai" href="sanpham.php?theloai=Sao&page=1&sapxep=" style="">
				<div class="imgg" style="">
					<img src="img/banner/biasaotruc.jpg" style="" >	
					<p style="width: 100%;">Sáo Trúc</p>
				</div>				
			</a>
		</div>
		<div class="iteam" style="">
			<a class="theloai" href="sanpham.php?theloai=Guitar&page=1&sapxep=" style="">
				<div class="imgg" style="">
					<img src="img/banner/biaguitar.jpg" style="" >	
					<p style="width: 100%;">Guitar</p>
				</div>				
			</a>
		</div>
		<div class="iteam" style="">
			<a class="theloai" href="sanpham.php?theloai=Saxophone&page=1&sapxep=" style="">
				<div class="imgg" style="">
					<img src="img/banner/biasaxophone.jpg" style="" >	
					<p style="width: 100%;">SaxoPhone</p>
				</div>				
			</a>
		</div>
		<div class="iteam" style="">
			<a class="theloai" href="sanpham.php?theloai=Violin&page=1&sapxep=" style="">
				<div class="imgg" style="">
					<img src="img/banner/biaviolin.jpg" style="" >	
					<p style="width: 100%;">Violin</p>
				</div>				
			</a>
		</div>	
		<div class="iteam" style="">
			<a class="theloai" href="sanpham.php?theloai=Trong&page=1&sapxep=" style="">
				<div class="imgg" style="">
					<img src="img/banner/biatrong.jpg" style="" >	
					<p style="width: 100%;">Trống</p>
				</div>				
			</a>
		</div>	
		<div class="iteam" style="">
			<a class="theloai" href="sanpham.php?theloai=Organ&page=1&sapxep=" style="">
				<div class="imgg" style="">
					<img src="img/banner/biaorgan.jpg" style="" >	
					<p style="width: 100%;">Organ</p>
				</div>				
			</a>
		</div>	

   	</div>
   	<div style="clear: both;"></div>
   	<div class="container uudai" >
   		<div class="title" style="position: relative;top: -17px;left: 350px;background-color: #fff;width: 360px; text-align: center;">
   			<img src="img/sale.jpg" alt="img/sale.jpg" width="50" height="30" style="float: left;margin-left: 10px;">
   			<h3 style="font-weight: bold;color: #000000cc;">SẢN PHẨM GIẢM GIÁ</h3>
   		</div>
   		<div class="row"style="animation: moveBottom 1s ease-out;">
   			<div class="col-lg-3 col-sm-6 col-12" >
   				<a href="chitietsanpham.php"  style="">
   					<div class="giamgia-box" >
   						<div class="timegiamgia" >
   							<span >1d:2h:06p:32s</span>
   						</div>
   						<div  class="giamgia">
	   						<span style="font-size: 13px;">-20%</span>
	   					</div>
   					</div>
	   				<div class="itemsp" >
	   					<div class="xemthem" >
	   						<span >Xem Thêm</span>
	   					</div>
	   					<div class="anhsp" >
	   						<img src="img/dan1.jpg"	 alt="img/dan1.jpg" style="width: 100% ;height:100%">
	   					</div>

	   					<div class="in4sp">
	   						<div class="tensp">
		   						<span style="">Kawai ND-21</span>
		   					</div>
		   					<div class="price">
		   						<span class="giathat" >190.000₫</span>
		   						<span class="giagiam" >190.000₫</span>
		   					</div>
	   					</div>
	   				</div>
   				</a>
   			</div>
   			<div class="col-lg-3 col-sm-6 col-12" >
   				<a href=""  style="">
   					<div class="giamgia-box" >
   						<div class="timegiamgia" >
   							<span >1d:2h:06p:32s</span>
   						</div>
   						<div  class="giamgia">
	   						<span style="font-size: 13px;">-20%</span>
	   					</div>
   					</div>
	   				<div class="itemsp" >
	   					<div class="xemthem" >
	   						<span >Xem Thêm</span>
	   					</div>
	   					<div class="anhsp" >
	   						<img src="img/dan10.jpg" alt="img/dan10.jpg" style="width: 100% ;height:100%">
	   					</div>

	   					<div class="in4sp">
	   						<div class="tensp">
		   						<span style="">Kawai ND-21</span>
		   					</div>
		   					<div class="price">
		   						<span class="giathat" >190.000₫</span>
		   						<span class="giagiam" >190.000₫</span>
		   					</div>
	   					</div>
	   				</div>
   				</a>
   			</div>
   			<div class="col-lg-3 col-sm-6 col-12" >
   				<a href=""  style="">
   					<div class="giamgia-box" >
   						<div class="timegiamgia" >
   							<span >1d:2h:06p:32s</span>
   						</div>
   						<div  class="giamgia">
	   						<span style="font-size: 13px;">-20%</span>
	   					</div>
   					</div>
	   				<div class="itemsp" >
	   					<div class="xemthem" >
	   						<span >Xem Thêm</span>
	   					</div>
	   					<div class="anhsp" >
	   						<img src="img/saxophone7.jpg"	 alt="img/saxophone7.jpg" style="width: 100% ;height:100%">
	   					</div>

	   					<div class="in4sp">
	   						<div class="tensp">
		   						<span style="">Kawai ND-21</span>
		   					</div>
		   					<div class="price">
		   						<span class="giathat" >190.000₫</span>
		   						<span class="giagiam" >190.000₫</span>
		   					</div>
	   					</div>
	   				</div>
   				</a>
   			</div>
   			<div class="col-lg-3 col-sm-6 col-12" >
   				<a href=""  style="">
   					<div class="giamgia-box" >
   						<div class="timegiamgia" >
   							<span >1d:2h:06p:32s</span>
   						</div>
   						<div  class="giamgia">
	   						<span style="font-size: 13px;">-20%</span>
	   					</div>
   					</div>
	   				<div class="itemsp" >
	   					<div class="xemthem" >
	   						<span >Xem Thêm</span>
	   					</div>
	   					<div class="anhsp" >
	   						<img src="img/trong4.jpg"	 alt="img/trong4.jpg" style="width: 100% ;height:100%">
	   					</div>

	   					<div class="in4sp">
	   						<div class="tensp">
		   						<span style="">Kawai ND-21</span>
		   					</div>
		   					<div class="price">
		   						<span class="giathat" >190.000₫</span>
		   						<span class="giagiam" >190.000₫</span>
		   					</div>
	   					</div>
	   				</div>
   				</a>
   			</div>   		
   		</div>
   		<div class="row" style="margin-top: 20px;animation: moveBottom 1s ease-out;">
   			<div class="col-12">
   				<a class="btn btn-white" href="sanpham.php">Xem Thêm</a>
   			</div>
   		</div>
   	</div>
   	<div class="container uudai" >
   		<div class="title" style="position: relative;top: -17px;left: 400px;background-color: #fff;width: 300px; text-align: center;">
   			<img src="img/new.jpg" alt="img/new.jpg" width="50" height="50" style="margin-top: -10px;float: left;margin-left: 10px;">
   			<h3 style=" margin-left: -10px;font-weight: bold;color: #000000cc;width: 300px;">SẢN PHẨM MỚI</h3>
   		</div>
   		<div class="row"style="animation: moveBottom 1s ease-out;">
   			<div class="col-lg-3 col-sm-6 col-12" >
   				<a href=""  style="">
   					<div class="giamgia-box" >
   						<div class="timegiamgia" >
   							<span >1d:2h:06p:32s</span>
   						</div>
   						<div  class="giamgia">
	   						<span style="font-size: 13px;">-20%</span>
	   					</div>
   					</div>
	   				<div class="itemsp" >
	   					<div class="xemthem" >
	   						<span >Xem Thêm</span>
	   					</div>
	   					<div class="anhsp" >
	   						<img src="img/dan1.jpg"	 alt="img/dan1.jpg" style="width: 100% ;height:100%">
	   					</div>

	   					<div class="in4sp">
	   						<div class="tensp">
		   						<span style="">Kawai ND-21</span>
		   					</div>
		   					<div class="price">
		   						<span class="giathat" >190.000₫</span>
		   						<span class="giagiam" >190.000₫</span>
		   					</div>
	   					</div>
	   				</div>
   				</a>
   			</div>
   			<div class="col-lg-3 col-sm-6 col-12" >
   				<a href=""  style="">
   					<div class="giamgia-box" >
   						<div class="timegiamgia" >
   							<span >1d:2h:06p:32s</span>
   						</div>
   						<div  class="giamgia">
	   						<span style="font-size: 13px;">-20%</span>
	   					</div>
   					</div>
	   				<div class="itemsp" >
	   					<div class="xemthem" >
	   						<span >Xem Thêm</span>
	   					</div>
	   					<div class="anhsp" >
	   						<img src="img/dan10.jpg" alt="img/dan10.jpg" style="width: 100% ;height:100%">
	   					</div>

	   					<div class="in4sp">
	   						<div class="tensp">
		   						<span style="">Kawai ND-21</span>
		   					</div>
		   					<div class="price">
		   						<span class="giathat" >190.000₫</span>
		   						<span class="giagiam" >190.000₫</span>
		   					</div>
	   					</div>
	   				</div>
   				</a>
   			</div>
   			<div class="col-lg-3 col-sm-6 col-12" >
   				<a href=""  style="">
   					<div class="giamgia-box" >
   						<div class="timegiamgia" >
   							<span >1d:2h:06p:32s</span>
   						</div>
   						<div  class="giamgia">
	   						<span style="font-size: 13px;">-20%</span>
	   					</div>
   					</div>
	   				<div class="itemsp" >
	   					<div class="xemthem" >
	   						<span >Xem Thêm</span>
	   					</div>
	   					<div class="anhsp" >
	   						<img src="img/saxophone7.jpg"	 alt="img/saxophone7.jpg" style="width: 100% ;height:100%">
	   					</div>

	   					<div class="in4sp">
	   						<div class="tensp">
		   						<span style="">Kawai ND-21</span>
		   					</div>
		   					<div class="price">
		   						<span class="giathat" >190.000₫</span>
		   						<span class="giagiam" >190.000₫</span>
		   					</div>
	   					</div>
	   				</div>
   				</a>
   			</div>
   			<div class="col-lg-3 col-sm-6 col-12" >
   				<a href=""  style="">
   					<div class="giamgia-box" >
   						<div class="timegiamgia" >
   							<span >1d:2h:06p:32s</span>
   						</div>
   						<div  class="giamgia">
	   						<span style="font-size: 13px;">-20%</span>
	   					</div>
   					</div>
	   				<div class="itemsp" >
	   					<div class="xemthem" >
	   						<span >Xem Thêm</span>
	   					</div>
	   					<div class="anhsp" >
	   						<img src="img/trong4.jpg"	 alt="img/trong4.jpg" style="width: 100% ;height:100%">
	   					</div>

	   					<div class="in4sp">
	   						<div class="tensp">
		   						<span style="">Kawai ND-21</span>
		   					</div>
		   					<div class="price">
		   						<span class="giathat" >190.000₫</span>
		   						<span class="giagiam" >190.000₫</span>
		   					</div>
	   					</div>
	   				</div>
   				</a>
   			</div>   		
   		</div>
   		<div class="row" style="margin-top: 20px;animation: moveBottom 1s ease-out;">
   			<div class="col-12">
   				<a class="btn btn-white" href="sanpham.php">Xem Thêm</a>
   			</div>
   		</div>
   	</div>
   	<div class="container uudai">
   		<div class="title" style="position: relative;top: -17px;left: 400px;background-color: #fff;width: 300px; text-align: center;">
   			<img src="img/hot.jpg" alt="img/hot.jpg" width="60" height="60" style="margin-top: -15px;float: left;margin-left: 10px;">
   			<h3 style=" margin-left: -10px;font-weight: bold;color: #000000cc;width: 300px;">SẢN PHẨM HOT</h3>
   		</div>
   		<div class="row"style="animation: moveBottom 1s ease-out;margin-left: 0px;margin-right: 0px;width: 100%;">
   			<div class="col-lg-3 col-sm-6 col-12" >
   				<a href=""  style="">
   					<div class="giamgia-box" >
   						<div class="timegiamgia" >
   							<span >1d:2h:06p:32s</span>
   						</div>
   						<div  class="giamgia">
	   						<span style="font-size: 13px;">-20%</span>
	   					</div>
   					</div>
	   				<div class="itemsp" >
	   					<div class="xemthem" >
	   						<span >Xem Thêm</span>
	   					</div>
	   					<div class="anhsp" >
	   						<img src="img/dan1.jpg"	 alt="img/dan1.jpg" style="width: 100% ;height:100%">
	   					</div>

	   					<div class="in4sp">
	   						<div class="tensp">
		   						<span style="">Kawai ND-21</span>
		   					</div>
		   					<div class="price">
		   						<span class="giathat" >190.000₫</span>
		   						<span class="giagiam" >190.000₫</span>
		   					</div>
	   					</div>
	   				</div>
   				</a>
   			</div>
   			<div class="col-lg-3 col-sm-6 col-12" >
   				<a href=""  style="">
   					<div class="giamgia-box" >
   						<div class="timegiamgia" >
   							<span >1d:2h:06p:32s</span>
   						</div>
   						<div  class="giamgia">
	   						<span style="font-size: 13px;">-20%</span>
	   					</div>
   					</div>
	   				<div class="itemsp" >
	   					<div class="xemthem" >
	   						<span >Xem Thêm</span>
	   					</div>
	   					<div class="anhsp" >
	   						<img src="img/dan10.jpg" alt="img/dan10.jpg" style="width: 100% ;height:100%">
	   					</div>

	   					<div class="in4sp">
	   						<div class="tensp">
		   						<span style="">Kawai ND-21</span>
		   					</div>
		   					<div class="price">
		   						<span class="giathat" >190.000₫</span>
		   						<span class="giagiam" >190.000₫</span>
		   					</div>
	   					</div>
	   				</div>
   				</a>
   			</div>
   			<div class="col-lg-3 col-sm-6 col-12" >
   				<a href=""  style="">
   					<div class="giamgia-box" >
   						<div class="timegiamgia" >
   							<span >1d:2h:06p:32s</span>
   						</div>
   						<div  class="giamgia">
	   						<span style="font-size: 13px;">-20%</span>
	   					</div>
   					</div>
	   				<div class="itemsp" >
	   					<div class="xemthem" >
	   						<span >Xem Thêm</span>
	   					</div>
	   					<div class="anhsp" >
	   						<img src="img/saxophone7.jpg"	 alt="img/saxophone7.jpg" style="width: 100% ;height:100%">
	   					</div>

	   					<div class="in4sp">
	   						<div class="tensp">
		   						<span style="">Kawai ND-21</span>
		   					</div>
		   					<div class="price">
		   						<span class="giathat" >190.000₫</span>
		   						<span class="giagiam" >190.000₫</span>
		   					</div>
	   					</div>
	   				</div>
   				</a>
   			</div>
   			<div class="col-lg-3 col-sm-6 col-12" >
   				<a href=""  style="">
   					<div class="giamgia-box" >
   						<div class="timegiamgia" >
   							<span >1d:2h:06p:32s</span>
   						</div>
   						<div  class="giamgia">
	   						<span style="font-size: 13px;">-20%</span>
	   					</div>
   					</div>
	   				<div class="itemsp" >
	   					<div class="xemthem" >
	   						<span >Xem Thêm</span>
	   					</div>
	   					<div class="anhsp" >
	   						<img src="img/trong4.jpg"	 alt="img/trong4.jpg" style="width: 100% ;height:100%">
	   					</div>

	   					<div class="in4sp">
	   						<div class="tensp">
		   						<span style="">Kawai ND-21</span>
		   					</div>
		   					<div class="price">
		   						<span class="giathat" >190.000₫</span>
		   						<span class="giagiam" >190.000₫</span>
		   					</div>
	   					</div>
	   				</div>
   				</a>
   			</div>   		
   		</div>
   		<div class="row" style="margin-top: 20px;animation: moveBottom 1s ease-out;">
   			<div class="col-12">
   				<a class="btn btn-white" href="sanpham.php">Xem Thêm</a>
   			</div>
   		</div>
   	</div>
   	<div class="container alltheloai">
   		<div class="title" style="position: relative;top: -50px;left: 0px;background-color: #fff;width: 180px; text-align: center;">
   			<img src="img/piano.png" alt="img/piano.png" width="60" height="60" style="margin-top: -15px;float: left;margin-left: 10px;">
   			<h3 style=" margin-left: -10px;font-weight: bold;color: #000000cc;">PIANO</h3>
   		</div>
   		<div id="demo1" class="carousel slide" data-ride="carousel">
	        <ul class="carousel-indicators">
	            <li data-target="#demo" data-slide-to="0" class="active"></li>
	            <li data-target="#myCarousel" data-slide-to="1"></li>
			    <li data-target="#myCarousel" data-slide-to="2"></li>                 
	        </ul>
	        <div class="carousel-inner">
	            <div class="carousel-item active">
	                <div class="row"style="animation: moveBottom 1s ease-out;">
			   			<div class="col-lg-3 col-sm-6 col-12" >
			   				<a href=""  style="">
			   					<div class="giamgia-box" >
			   						<div class="timegiamgia" >
			   							<span >1d:2h:06p:32s</span>
			   						</div>
			   						<div  class="giamgia">
				   						<span style="font-size: 13px;">-20%</span>
				   					</div>
			   					</div>
				   				<div class="itemsp" >
				   					<div class="xemthem" >
				   						<span >Xem Thêm</span>
				   					</div>
				   					<div class="anhsp" >
				   						<img src="img/dan1.jpg"	 alt="img/dan1.jpg" style="width: 100% ;height:100%">
				   					</div>

				   					<div class="in4sp">
				   						<div class="tensp">
					   						<span style="">Kawai ND-21</span>
					   					</div>
					   					<div class="price">
					   						<span class="giathat" >190.000₫</span>
					   						<span class="giagiam" >190.000₫</span>
					   					</div>
				   					</div>
				   				</div>
			   				</a>
			   			</div>
			   			<div class="col-lg-3 col-sm-6 col-12" >
			   				<a href=""  style="">
			   					<div class="giamgia-box" >
			   						<div class="timegiamgia" >
			   							<span >1d:2h:06p:32s</span>
			   						</div>
			   						<div  class="giamgia">
				   						<span style="font-size: 13px;">-20%</span>
				   					</div>
			   					</div>
				   				<div class="itemsp" >
				   					<div class="xemthem" >
				   						<span >Xem Thêm</span>
				   					</div>
				   					<div class="anhsp" >
				   						<img src="img/dan10.jpg" alt="img/dan10.jpg" style="width: 100% ;height:100%">
				   					</div>

				   					<div class="in4sp">
				   						<div class="tensp">
					   						<span style="">Kawai ND-21</span>
					   					</div>
					   					<div class="price">
					   						<span class="giathat" >190.000₫</span>
					   						<span class="giagiam" >190.000₫</span>
					   					</div>
				   					</div>
				   				</div>
			   				</a>
			   			</div>
			   			<div class="col-lg-3 col-sm-6 col-12" >
			   				<a href=""  style="">
			   					<div class="giamgia-box" >
			   						<div class="timegiamgia" >
			   							<span >1d:2h:06p:32s</span>
			   						</div>
			   						<div  class="giamgia">
				   						<span style="font-size: 13px;">-20%</span>
				   					</div>
			   					</div>
				   				<div class="itemsp" >
				   					<div class="xemthem" >
				   						<span >Xem Thêm</span>
				   					</div>
				   					<div class="anhsp" >
				   						<img src="img/saxophone7.jpg"	 alt="img/saxophone7.jpg" style="width: 100% ;height:100%">
				   					</div>

				   					<div class="in4sp">
				   						<div class="tensp">
					   						<span style="">Kawai ND-21</span>
					   					</div>
					   					<div class="price">
					   						<span class="giathat" >190.000₫</span>
					   						<span class="giagiam" >190.000₫</span>
					   					</div>
				   					</div>
				   				</div>
			   				</a>
			   			</div>
			   			<div class="col-lg-3 col-sm-6 col-12" >
			   				<a href=""  style="">
			   					<div class="giamgia-box" >
			   						<div class="timegiamgia" >
			   							<span >1d:2h:06p:32s</span>
			   						</div>
			   						<div  class="giamgia">
				   						<span style="font-size: 13px;">-20%</span>
				   					</div>
			   					</div>
				   				<div class="itemsp" >
				   					<div class="xemthem" >
				   						<span >Xem Thêm</span>
				   					</div>
				   					<div class="anhsp" >
				   						<img src="img/trong4.jpg"	 alt="img/trong4.jpg" style="width: 100% ;height:100%">
				   					</div>

				   					<div class="in4sp">
				   						<div class="tensp">
					   						<span style="">Kawai ND-21</span>
					   					</div>
					   					<div class="price">
					   						<span class="giathat" >190.000₫</span>
					   						<span class="giagiam" >190.000₫</span>
					   					</div>
				   					</div>
				   				</div>
			   				</a>
			   			</div>   		
			   		</div>
	            </div>           
	            <div class="carousel-item">
	                <div class="row"style="animation: moveBottom 1s ease-out;">
			   			<div class="col-lg-3 col-sm-6 col-12" >
			   				<a href=""  style="">
			   					<div class="giamgia-box" >
			   						<div class="timegiamgia" >
			   							<span >1d:2h:06p:32s</span>
			   						</div>
			   						<div  class="giamgia">
				   						<span style="font-size: 13px;">-20%</span>
				   					</div>
			   					</div>
				   				<div class="itemsp" >
				   					<div class="xemthem" >
				   						<span >Xem Thêm</span>
				   					</div>
				   					<div class="anhsp" >
				   						<img src="img/dan1.jpg"	 alt="img/dan1.jpg" style="width: 100% ;height:100%">
				   					</div>

				   					<div class="in4sp">
				   						<div class="tensp">
					   						<span style="">Kawai ND-21</span>
					   					</div>
					   					<div class="price">
					   						<span class="giathat" >190.000₫</span>
					   						<span class="giagiam" >190.000₫</span>
					   					</div>
				   					</div>
				   				</div>
			   				</a>
			   			</div>
			   			<div class="col-lg-3 col-sm-6 col-12" >
			   				<a href=""  style="">
			   					<div class="giamgia-box" >
			   						<div class="timegiamgia" >
			   							<span >1d:2h:06p:32s</span>
			   						</div>
			   						<div  class="giamgia">
				   						<span style="font-size: 13px;">-20%</span>
				   					</div>
			   					</div>
				   				<div class="itemsp" >
				   					<div class="xemthem" >
				   						<span >Xem Thêm</span>
				   					</div>
				   					<div class="anhsp" >
				   						<img src="img/dan10.jpg" alt="img/dan10.jpg" style="width: 100% ;height:100%">
				   					</div>

				   					<div class="in4sp">
				   						<div class="tensp">
					   						<span style="">Kawai ND-21</span>
					   					</div>
					   					<div class="price">
					   						<span class="giathat" >190.000₫</span>
					   						<span class="giagiam" >190.000₫</span>
					   					</div>
				   					</div>
				   				</div>
			   				</a>
			   			</div>
			   			<div class="col-lg-3 col-sm-6 col-12" >
			   				<a href=""  style="">
			   					<div class="giamgia-box" >
			   						<div class="timegiamgia" >
			   							<span >1d:2h:06p:32s</span>
			   						</div>
			   						<div  class="giamgia">
				   						<span style="font-size: 13px;">-20%</span>
				   					</div>
			   					</div>
				   				<div class="itemsp" >
				   					<div class="xemthem" >
				   						<span >Xem Thêm</span>
				   					</div>
				   					<div class="anhsp" >
				   						<img src="img/saxophone7.jpg"	 alt="img/saxophone7.jpg" style="width: 100% ;height:100%">
				   					</div>

				   					<div class="in4sp">
				   						<div class="tensp">
					   						<span style="">Kawai ND-21</span>
					   					</div>
					   					<div class="price">
					   						<span class="giathat" >190.000₫</span>
					   						<span class="giagiam" >190.000₫</span>
					   					</div>
				   					</div>
				   				</div>
			   				</a>
			   			</div>
			   			<div class="col-lg-3 col-sm-6 col-12" >
			   				<a href=""  style="">
			   					<div class="giamgia-box" >
			   						<div class="timegiamgia" >
			   							<span >1d:2h:06p:32s</span>
			   						</div>
			   						<div  class="giamgia">
				   						<span style="font-size: 13px;">-20%</span>
				   					</div>
			   					</div>
				   				<div class="itemsp" >
				   					<div class="xemthem" >
				   						<span >Xem Thêm</span>
				   					</div>
				   					<div class="anhsp" >
				   						<img src="img/trong4.jpg"	 alt="img/trong4.jpg" style="width: 100% ;height:100%">
				   					</div>

				   					<div class="in4sp">
				   						<div class="tensp">
					   						<span style="">Kawai ND-21</span>
					   					</div>
					   					<div class="price">
					   						<span class="giathat" >190.000₫</span>
					   						<span class="giagiam" >190.000₫</span>
					   					</div>
				   					</div>
				   				</div>
			   				</a>
			   			</div>   		
			   		</div>
	            </div>
	            <div class="carousel-item">
	                <div class="row"style="animation: moveBottom 1s ease-out;">
			   			<div class="col-lg-3 col-sm-6 col-12" >
			   				<a href=""  style="">
			   					<div class="giamgia-box" >
			   						<div class="timegiamgia" >
			   							<span >1d:2h:06p:32s</span>
			   						</div>
			   						<div  class="giamgia">
				   						<span style="font-size: 13px;">-20%</span>
				   					</div>
			   					</div>
				   				<div class="itemsp" >
				   					<div class="xemthem" >
				   						<span >Xem Thêm</span>
				   					</div>
				   					<div class="anhsp" >
				   						<img src="img/dan1.jpg"	 alt="img/dan1.jpg" style="width: 100% ;height:100%">
				   					</div>

				   					<div class="in4sp">
				   						<div class="tensp">
					   						<span style="">Kawai ND-21</span>
					   					</div>
					   					<div class="price">
					   						<span class="giathat" >190.000₫</span>
					   						<span class="giagiam" >190.000₫</span>
					   					</div>
				   					</div>
				   				</div>
			   				</a>
			   			</div>
			   			<div class="col-lg-3 col-sm-6 col-12" >
			   				<a href=""  style="">
			   					<div class="giamgia-box" >
			   						<div class="timegiamgia" >
			   							<span >1d:2h:06p:32s</span>
			   						</div>
			   						<div  class="giamgia">
				   						<span style="font-size: 13px;">-20%</span>
				   					</div>
			   					</div>
				   				<div class="itemsp" >
				   					<div class="xemthem" >
				   						<span >Xem Thêm</span>
				   					</div>
				   					<div class="anhsp" >
				   						<img src="img/dan10.jpg" alt="img/dan10.jpg" style="width: 100% ;height:100%">
				   					</div>

				   					<div class="in4sp">
				   						<div class="tensp">
					   						<span style="">Kawai ND-21</span>
					   					</div>
					   					<div class="price">
					   						<span class="giathat" >190.000₫</span>
					   						<span class="giagiam" >190.000₫</span>
					   					</div>
				   					</div>
				   				</div>
			   				</a>
			   			</div>
			   			<div class="col-lg-3 col-sm-6 col-12" >
			   				<a href=""  style="">
			   					<div class="giamgia-box" >
			   						<div class="timegiamgia" >
			   							<span >1d:2h:06p:32s</span>
			   						</div>
			   						<div  class="giamgia">
				   						<span style="font-size: 13px;">-20%</span>
				   					</div>
			   					</div>
				   				<div class="itemsp" >
				   					<div class="xemthem" >
				   						<span >Xem Thêm</span>
				   					</div>
				   					<div class="anhsp" >
				   						<img src="img/saxophone7.jpg"	 alt="img/saxophone7.jpg" style="width: 100% ;height:100%">
				   					</div>

				   					<div class="in4sp">
				   						<div class="tensp">
					   						<span style="">Kawai ND-21</span>
					   					</div>
					   					<div class="price">
					   						<span class="giathat" >190.000₫</span>
					   						<span class="giagiam" >190.000₫</span>
					   					</div>
				   					</div>
				   				</div>
			   				</a>
			   			</div>
			   			<div class="col-lg-3 col-sm-6 col-12" >
			   				<a href=""  style="">
			   					<div class="giamgia-box" >
			   						<div class="timegiamgia" >
			   							<span >1d:2h:06p:32s</span>
			   						</div>
			   						<div  class="giamgia">
				   						<span style="font-size: 13px;">-20%</span>
				   					</div>
			   					</div>
				   				<div class="itemsp" >
				   					<div class="xemthem" >
				   						<span >Xem Thêm</span>
				   					</div>
				   					<div class="anhsp" >
				   						<img src="img/trong4.jpg"	 alt="img/trong4.jpg" style="width: 100% ;height:100%">
				   					</div>

				   					<div class="in4sp">
				   						<div class="tensp">
					   						<span style="">Kawai ND-21</span>
					   					</div>
					   					<div class="price">
					   						<span class="giathat" >190.000₫</span>
					   						<span class="giagiam" >190.000₫</span>
					   					</div>
				   					</div>
				   				</div>
			   				</a>
			   			</div>   		
			   		</div>
	            </div>
	        </div>
	         <a class="carousel-control-prev" href="#demo1" style="position: absolute;left: -100px;width: 50px;height: 50px;top:150px;" data-slide="prev">
	            <span style="background-color: #00000054;padding: 15px;border-radius: 10px;" class="carousel-control-prev-icon"></span>
	        </a>
	        <a class="carousel-control-next" style="position: absolute;right: -100px;width: 50px;height: 50px;top:150px;" href="#demo1" data-slide="next">
	            <span style="background-color: #00000054;padding: 15px;border-radius: 10px;" class="carousel-control-next-icon"></span>
	        </a>
	    </div>
   		
   		<div class="row" style="margin-top: 20px;animation: moveBottom 1s ease-out;margin-bottom: 10px;">
   			<div class="col-12">
   				<a class="btn btn-white" href="sanpham.php">Xem Thêm</a>
   			</div>
   		</div>
   	</div>
   	<div class="container alltheloai" >
   		<div class="title" style="position: relative;top: -50px;left: 0px;background-color: #fff;width: 180px; text-align: center;">
   			<img src="img/guitar.png" alt="img/guitar.png" width="60" height="60" style="margin-top: -15px;float: left;margin-left: 10px;">
   			<h3 style=" margin-left: -10px;font-weight: bold;color: #000000cc;">GUITAR</h3>
   		</div>
   		<div id="demo2" class="carousel slide" data-ride="carousel">
	        <ul class="carousel-indicators">
	            <li data-target="#demo" data-slide-to="0" class="active"></li>
	            <li data-target="#myCarousel" data-slide-to="1"></li>
			    <li data-target="#myCarousel" data-slide-to="2"></li>                 
	        </ul>
	        <div class="carousel-inner">
	            <div class="carousel-item active">
	                <div class="row"style="animation: moveBottom 1s ease-out;">
			   			<div class="col-lg-3 col-sm-6 col-12" >
			   				<a href=""  style="">
			   					<div class="giamgia-box" >
			   						<div class="timegiamgia" >
			   							<span >1d:2h:06p:32s</span>
			   						</div>
			   						<div  class="giamgia">
				   						<span style="font-size: 13px;">-20%</span>
				   					</div>
			   					</div>
				   				<div class="itemsp" >
				   					<div class="xemthem" >
				   						<span >Xem Thêm</span>
				   					</div>
				   					<div class="anhsp" >
				   						<img src="img/dan1.jpg"	 alt="img/dan1.jpg" style="width: 100% ;height:100%">
				   					</div>

				   					<div class="in4sp">
				   						<div class="tensp">
					   						<span style="">Kawai ND-21</span>
					   					</div>
					   					<div class="price">
					   						<span class="giathat" >190.000₫</span>
					   						<span class="giagiam" >190.000₫</span>
					   					</div>
				   					</div>
				   				</div>
			   				</a>
			   			</div>
			   			<div class="col-lg-3 col-sm-6 col-12" >
			   				<a href=""  style="">
			   					<div class="giamgia-box" >
			   						<div class="timegiamgia" >
			   							<span >1d:2h:06p:32s</span>
			   						</div>
			   						<div  class="giamgia">
				   						<span style="font-size: 13px;">-20%</span>
				   					</div>
			   					</div>
				   				<div class="itemsp" >
				   					<div class="xemthem" >
				   						<span >Xem Thêm</span>
				   					</div>
				   					<div class="anhsp" >
				   						<img src="img/dan10.jpg" alt="img/dan10.jpg" style="width: 100% ;height:100%">
				   					</div>

				   					<div class="in4sp">
				   						<div class="tensp">
					   						<span style="">Kawai ND-21</span>
					   					</div>
					   					<div class="price">
					   						<span class="giathat" >190.000₫</span>
					   						<span class="giagiam" >190.000₫</span>
					   					</div>
				   					</div>
				   				</div>
			   				</a>
			   			</div>
			   			<div class="col-lg-3 col-sm-6 col-12" >
			   				<a href=""  style="">
			   					<div class="giamgia-box" >
			   						<div class="timegiamgia" >
			   							<span >1d:2h:06p:32s</span>
			   						</div>
			   						<div  class="giamgia">
				   						<span style="font-size: 13px;">-20%</span>
				   					</div>
			   					</div>
				   				<div class="itemsp" >
				   					<div class="xemthem" >
				   						<span >Xem Thêm</span>
				   					</div>
				   					<div class="anhsp" >
				   						<img src="img/saxophone7.jpg"	 alt="img/saxophone7.jpg" style="width: 100% ;height:100%">
				   					</div>

				   					<div class="in4sp">
				   						<div class="tensp">
					   						<span style="">Kawai ND-21</span>
					   					</div>
					   					<div class="price">
					   						<span class="giathat" >190.000₫</span>
					   						<span class="giagiam" >190.000₫</span>
					   					</div>
				   					</div>
				   				</div>
			   				</a>
			   			</div>
			   			<div class="col-lg-3 col-sm-6 col-12" >
			   				<a href=""  style="">
			   					<div class="giamgia-box" >
			   						<div class="timegiamgia" >
			   							<span >1d:2h:06p:32s</span>
			   						</div>
			   						<div  class="giamgia">
				   						<span style="font-size: 13px;">-20%</span>
				   					</div>
			   					</div>
				   				<div class="itemsp" >
				   					<div class="xemthem" >
				   						<span >Xem Thêm</span>
				   					</div>
				   					<div class="anhsp" >
				   						<img src="img/trong4.jpg"	 alt="img/trong4.jpg" style="width: 100% ;height:100%">
				   					</div>

				   					<div class="in4sp">
				   						<div class="tensp">
					   						<span style="">Kawai ND-21</span>
					   					</div>
					   					<div class="price">
					   						<span class="giathat" >190.000₫</span>
					   						<span class="giagiam" >190.000₫</span>
					   					</div>
				   					</div>
				   				</div>
			   				</a>
			   			</div>   		
			   		</div>
	            </div>           
	            <div class="carousel-item">
	                <div class="row"style="animation: moveBottom 1s ease-out;">
			   			<div class="col-lg-3 col-sm-6 col-12" >
			   				<a href=""  style="">
			   					<div class="giamgia-box" >
			   						<div class="timegiamgia" >
			   							<span >1d:2h:06p:32s</span>
			   						</div>
			   						<div  class="giamgia">
				   						<span style="font-size: 13px;">-20%</span>
				   					</div>
			   					</div>
				   				<div class="itemsp" >
				   					<div class="xemthem" >
				   						<span >Xem Thêm</span>
				   					</div>
				   					<div class="anhsp" >
				   						<img src="img/dan1.jpg"	 alt="img/dan1.jpg" style="width: 100% ;height:100%">
				   					</div>

				   					<div class="in4sp">
				   						<div class="tensp">
					   						<span style="">Kawai ND-21</span>
					   					</div>
					   					<div class="price">
					   						<span class="giathat" >190.000₫</span>
					   						<span class="giagiam" >190.000₫</span>
					   					</div>
				   					</div>
				   				</div>
			   				</a>
			   			</div>
			   			<div class="col-lg-3 col-sm-6 col-12" >
			   				<a href=""  style="">
			   					<div class="giamgia-box" >
			   						<div class="timegiamgia" >
			   							<span >1d:2h:06p:32s</span>
			   						</div>
			   						<div  class="giamgia">
				   						<span style="font-size: 13px;">-20%</span>
				   					</div>
			   					</div>
				   				<div class="itemsp" >
				   					<div class="xemthem" >
				   						<span >Xem Thêm</span>
				   					</div>
				   					<div class="anhsp" >
				   						<img src="img/dan10.jpg" alt="img/dan10.jpg" style="width: 100% ;height:100%">
				   					</div>

				   					<div class="in4sp">
				   						<div class="tensp">
					   						<span style="">Kawai ND-21</span>
					   					</div>
					   					<div class="price">
					   						<span class="giathat" >190.000₫</span>
					   						<span class="giagiam" >190.000₫</span>
					   					</div>
				   					</div>
				   				</div>
			   				</a>
			   			</div>
			   			<div class="col-lg-3 col-sm-6 col-12" >
			   				<a href=""  style="">
			   					<div class="giamgia-box" >
			   						<div class="timegiamgia" >
			   							<span >1d:2h:06p:32s</span>
			   						</div>
			   						<div  class="giamgia">
				   						<span style="font-size: 13px;">-20%</span>
				   					</div>
			   					</div>
				   				<div class="itemsp" >
				   					<div class="xemthem" >
				   						<span >Xem Thêm</span>
				   					</div>
				   					<div class="anhsp" >
				   						<img src="img/saxophone7.jpg"	 alt="img/saxophone7.jpg" style="width: 100% ;height:100%">
				   					</div>

				   					<div class="in4sp">
				   						<div class="tensp">
					   						<span style="">Kawai ND-21</span>
					   					</div>
					   					<div class="price">
					   						<span class="giathat" >190.000₫</span>
					   						<span class="giagiam" >190.000₫</span>
					   					</div>
				   					</div>
				   				</div>
			   				</a>
			   			</div>
			   			<div class="col-lg-3 col-sm-6 col-12" >
			   				<a href=""  style="">
			   					<div class="giamgia-box" >
			   						<div class="timegiamgia" >
			   							<span >1d:2h:06p:32s</span>
			   						</div>
			   						<div  class="giamgia">
				   						<span style="font-size: 13px;">-20%</span>
				   					</div>
			   					</div>
				   				<div class="itemsp" >
				   					<div class="xemthem" >
				   						<span >Xem Thêm</span>
				   					</div>
				   					<div class="anhsp" >
				   						<img src="img/trong4.jpg"	 alt="img/trong4.jpg" style="width: 100% ;height:100%">
				   					</div>

				   					<div class="in4sp">
				   						<div class="tensp">
					   						<span style="">Kawai ND-21</span>
					   					</div>
					   					<div class="price">
					   						<span class="giathat" >190.000₫</span>
					   						<span class="giagiam" >190.000₫</span>
					   					</div>
				   					</div>
				   				</div>
			   				</a>
			   			</div>   		
			   		</div>
	            </div>
	            <div class="carousel-item">
	                <div class="row"style="animation: moveBottom 1s ease-out;">
			   			<div class="col-lg-3 col-sm-6 col-12" >
			   				<a href=""  style="">
			   					<div class="giamgia-box" >
			   						<div class="timegiamgia" >
			   							<span >1d:2h:06p:32s</span>
			   						</div>
			   						<div  class="giamgia">
				   						<span style="font-size: 13px;">-20%</span>
				   					</div>
			   					</div>
				   				<div class="itemsp" >
				   					<div class="xemthem" >
				   						<span >Xem Thêm</span>
				   					</div>
				   					<div class="anhsp" >
				   						<img src="img/dan1.jpg"	 alt="img/dan1.jpg" style="width: 100% ;height:100%">
				   					</div>

				   					<div class="in4sp">
				   						<div class="tensp">
					   						<span style="">Kawai ND-21</span>
					   					</div>
					   					<div class="price">
					   						<span class="giathat" >190.000₫</span>
					   						<span class="giagiam" >190.000₫</span>
					   					</div>
				   					</div>
				   				</div>
			   				</a>
			   			</div>
			   			<div class="col-lg-3 col-sm-6 col-12" >
			   				<a href=""  style="">
			   					<div class="giamgia-box" >
			   						<div class="timegiamgia" >
			   							<span >1d:2h:06p:32s</span>
			   						</div>
			   						<div  class="giamgia">
				   						<span style="font-size: 13px;">-20%</span>
				   					</div>
			   					</div>
				   				<div class="itemsp" >
				   					<div class="xemthem" >
				   						<span >Xem Thêm</span>
				   					</div>
				   					<div class="anhsp" >
				   						<img src="img/dan10.jpg" alt="img/dan10.jpg" style="width: 100% ;height:100%">
				   					</div>

				   					<div class="in4sp">
				   						<div class="tensp">
					   						<span style="">Kawai ND-21</span>
					   					</div>
					   					<div class="price">
					   						<span class="giathat" >190.000₫</span>
					   						<span class="giagiam" >190.000₫</span>
					   					</div>
				   					</div>
				   				</div>
			   				</a>
			   			</div>
			   			<div class="col-lg-3 col-sm-6 col-12" >
			   				<a href=""  style="">
			   					<div class="giamgia-box" >
			   						<div class="timegiamgia" >
			   							<span >1d:2h:06p:32s</span>
			   						</div>
			   						<div  class="giamgia">
				   						<span style="font-size: 13px;">-20%</span>
				   					</div>
			   					</div>
				   				<div class="itemsp" >
				   					<div class="xemthem" >
				   						<span >Xem Thêm</span>
				   					</div>
				   					<div class="anhsp" >
				   						<img src="img/saxophone7.jpg"	 alt="img/saxophone7.jpg" style="width: 100% ;height:100%">
				   					</div>

				   					<div class="in4sp">
				   						<div class="tensp">
					   						<span style="">Kawai ND-21</span>
					   					</div>
					   					<div class="price">
					   						<span class="giathat" >190.000₫</span>
					   						<span class="giagiam" >190.000₫</span>
					   					</div>
				   					</div>
				   				</div>
			   				</a>
			   			</div>
			   			<div class="col-lg-3 col-sm-6 col-12" >
			   				<a href=""  style="">
			   					<div class="giamgia-box" >
			   						<div class="timegiamgia" >
			   							<span >1d:2h:06p:32s</span>
			   						</div>
			   						<div  class="giamgia">
				   						<span style="font-size: 13px;">-20%</span>
				   					</div>
			   					</div>
				   				<div class="itemsp" >
				   					<div class="xemthem" >
				   						<span >Xem Thêm</span>
				   					</div>
				   					<div class="anhsp" >
				   						<img src="img/trong4.jpg"	 alt="img/trong4.jpg" style="width: 100% ;height:100%">
				   					</div>

				   					<div class="in4sp">
				   						<div class="tensp">
					   						<span style="">Kawai ND-21</span>
					   					</div>
					   					<div class="price">
					   						<span class="giathat" >190.000₫</span>
					   						<span class="giagiam" >190.000₫</span>
					   					</div>
				   					</div>
				   				</div>
			   				</a>
			   			</div>   		
			   		</div>
	            </div>
	        </div>
	         <a class="carousel-control-prev" href="#demo2" style="position: absolute;left: -100px;width: 50px;height: 50px;top:150px;" data-slide="prev">
	            <span style="background-color: #00000054;padding: 15px;border-radius: 10px;" class="carousel-control-prev-icon"></span>
	        </a>
	        <a class="carousel-control-next" style="position: absolute;right: -100px;width: 50px;height: 50px;top:150px;" href="#demo2" data-slide="next">
	            <span style="background-color: #00000054;padding: 15px;border-radius: 10px;" class="carousel-control-next-icon"></span>
	        </a>
	    </div>
   		
   		<div class="row" style="margin-top: 20px;animation: moveBottom 1s ease-out;margin-bottom: 10px;">
   			<div class="col-12">
   				<a class="btn btn-white" href="sanpham.php">Xem Thêm</a>
   			</div>
   		</div>
   	</div>
   	<div class="container alltheloai">
   		<div class="title" style="position: relative;top: -50px;left: 0px;background-color: #fff;width: 180px; text-align: center;">
   			<img src="img/rum.png" alt="img/rum.png" width="60" height="60" style="margin-top: -15px;float: left;margin-left: 10px;">
   			<h3 style=" margin-left: -10px;font-weight: bold;color: #000000cc;">DRUM</h3>
   		</div>
   		<div id="demo3" class="carousel slide" data-ride="carousel">
	        <ul class="carousel-indicators">
	            <li data-target="#demo" data-slide-to="0" class="active"></li>
	            <li data-target="#myCarousel" data-slide-to="1"></li>
			    <li data-target="#myCarousel" data-slide-to="2"></li>                 
	        </ul>
	        <div class="carousel-inner">
	            <div class="carousel-item active">
	                <div class="row"style="animation: moveBottom 1s ease-out;">
			   			<div class="col-lg-3 col-sm-6 col-12" >
			   				<a href=""  style="">
			   					<div class="giamgia-box" >
			   						<div class="timegiamgia" >
			   							<span >1d:2h:06p:32s</span>
			   						</div>
			   						<div  class="giamgia">
				   						<span style="font-size: 13px;">-20%</span>
				   					</div>
			   					</div>
				   				<div class="itemsp" >
				   					<div class="xemthem" >
				   						<span >Xem Thêm</span>
				   					</div>
				   					<div class="anhsp" >
				   						<img src="img/dan1.jpg"	 alt="img/dan1.jpg" style="width: 100% ;height:100%">
				   					</div>

				   					<div class="in4sp">
				   						<div class="tensp">
					   						<span style="">Kawai ND-21</span>
					   					</div>
					   					<div class="price">
					   						<span class="giathat" >190.000₫</span>
					   						<span class="giagiam" >190.000₫</span>
					   					</div>
				   					</div>
				   				</div>
			   				</a>
			   			</div>
			   			<div class="col-lg-3 col-sm-6 col-12" >
			   				<a href=""  style="">
			   					<div class="giamgia-box" >
			   						<div class="timegiamgia" >
			   							<span >1d:2h:06p:32s</span>
			   						</div>
			   						<div  class="giamgia">
				   						<span style="font-size: 13px;">-20%</span>
				   					</div>
			   					</div>
				   				<div class="itemsp" >
				   					<div class="xemthem" >
				   						<span >Xem Thêm</span>
				   					</div>
				   					<div class="anhsp" >
				   						<img src="img/dan10.jpg" alt="img/dan10.jpg" style="width: 100% ;height:100%">
				   					</div>

				   					<div class="in4sp">
				   						<div class="tensp">
					   						<span style="">Kawai ND-21</span>
					   					</div>
					   					<div class="price">
					   						<span class="giathat" >190.000₫</span>
					   						<span class="giagiam" >190.000₫</span>
					   					</div>
				   					</div>
				   				</div>
			   				</a>
			   			</div>
			   			<div class="col-lg-3 col-sm-6 col-12" >
			   				<a href=""  style="">
			   					<div class="giamgia-box" >
			   						<div class="timegiamgia" >
			   							<span >1d:2h:06p:32s</span>
			   						</div>
			   						<div  class="giamgia">
				   						<span style="font-size: 13px;">-20%</span>
				   					</div>
			   					</div>
				   				<div class="itemsp" >
				   					<div class="xemthem" >
				   						<span >Xem Thêm</span>
				   					</div>
				   					<div class="anhsp" >
				   						<img src="img/saxophone7.jpg"	 alt="img/saxophone7.jpg" style="width: 100% ;height:100%">
				   					</div>

				   					<div class="in4sp">
				   						<div class="tensp">
					   						<span style="">Kawai ND-21</span>
					   					</div>
					   					<div class="price">
					   						<span class="giathat" >190.000₫</span>
					   						<span class="giagiam" >190.000₫</span>
					   					</div>
				   					</div>
				   				</div>
			   				</a>
			   			</div>
			   			<div class="col-lg-3 col-sm-6 col-12" >
			   				<a href=""  style="">
			   					<div class="giamgia-box" >
			   						<div class="timegiamgia" >
			   							<span >1d:2h:06p:32s</span>
			   						</div>
			   						<div  class="giamgia">
				   						<span style="font-size: 13px;">-20%</span>
				   					</div>
			   					</div>
				   				<div class="itemsp" >
				   					<div class="xemthem" >
				   						<span >Xem Thêm</span>
				   					</div>
				   					<div class="anhsp" >
				   						<img src="img/trong4.jpg"	 alt="img/trong4.jpg" style="width: 100% ;height:100%">
				   					</div>

				   					<div class="in4sp">
				   						<div class="tensp">
					   						<span style="">Kawai ND-21</span>
					   					</div>
					   					<div class="price">
					   						<span class="giathat" >190.000₫</span>
					   						<span class="giagiam" >190.000₫</span>
					   					</div>
				   					</div>
				   				</div>
			   				</a>
			   			</div>   		
			   		</div>
	            </div>           
	            <div class="carousel-item">
	                <div class="row"style="animation: moveBottom 1s ease-out;">
			   			<div class="col-lg-3 col-sm-6 col-12" >
			   				<a href=""  style="">
			   					<div class="giamgia-box" >
			   						<div class="timegiamgia" >
			   							<span >1d:2h:06p:32s</span>
			   						</div>
			   						<div  class="giamgia">
				   						<span style="font-size: 13px;">-20%</span>
				   					</div>
			   					</div>
				   				<div class="itemsp" >
				   					<div class="xemthem" >
				   						<span >Xem Thêm</span>
				   					</div>
				   					<div class="anhsp" >
				   						<img src="img/dan1.jpg"	 alt="img/dan1.jpg" style="width: 100% ;height:100%">
				   					</div>

				   					<div class="in4sp">
				   						<div class="tensp">
					   						<span style="">Kawai ND-21</span>
					   					</div>
					   					<div class="price">
					   						<span class="giathat" >190.000₫</span>
					   						<span class="giagiam" >190.000₫</span>
					   					</div>
				   					</div>
				   				</div>
			   				</a>
			   			</div>
			   			<div class="col-lg-3 col-sm-6 col-12" >
			   				<a href=""  style="">
			   					<div class="giamgia-box" >
			   						<div class="timegiamgia" >
			   							<span >1d:2h:06p:32s</span>
			   						</div>
			   						<div  class="giamgia">
				   						<span style="font-size: 13px;">-20%</span>
				   					</div>
			   					</div>
				   				<div class="itemsp" >
				   					<div class="xemthem" >
				   						<span >Xem Thêm</span>
				   					</div>
				   					<div class="anhsp" >
				   						<img src="img/dan10.jpg" alt="img/dan10.jpg" style="width: 100% ;height:100%">
				   					</div>

				   					<div class="in4sp">
				   						<div class="tensp">
					   						<span style="">Kawai ND-21</span>
					   					</div>
					   					<div class="price">
					   						<span class="giathat" >190.000₫</span>
					   						<span class="giagiam" >190.000₫</span>
					   					</div>
				   					</div>
				   				</div>
			   				</a>
			   			</div>
			   			<div class="col-lg-3 col-sm-6 col-12" >
			   				<a href=""  style="">
			   					<div class="giamgia-box" >
			   						<div class="timegiamgia" >
			   							<span >1d:2h:06p:32s</span>
			   						</div>
			   						<div  class="giamgia">
				   						<span style="font-size: 13px;">-20%</span>
				   					</div>
			   					</div>
				   				<div class="itemsp" >
				   					<div class="xemthem" >
				   						<span >Xem Thêm</span>
				   					</div>
				   					<div class="anhsp" >
				   						<img src="img/saxophone7.jpg"	 alt="img/saxophone7.jpg" style="width: 100% ;height:100%">
				   					</div>

				   					<div class="in4sp">
				   						<div class="tensp">
					   						<span style="">Kawai ND-21</span>
					   					</div>
					   					<div class="price">
					   						<span class="giathat" >190.000₫</span>
					   						<span class="giagiam" >190.000₫</span>
					   					</div>
				   					</div>
				   				</div>
			   				</a>
			   			</div>
			   			<div class="col-lg-3 col-sm-6 col-12" >
			   				<a href=""  style="">
			   					<div class="giamgia-box" >
			   						<div class="timegiamgia" >
			   							<span >1d:2h:06p:32s</span>
			   						</div>
			   						<div  class="giamgia">
				   						<span style="font-size: 13px;">-20%</span>
				   					</div>
			   					</div>
				   				<div class="itemsp" >
				   					<div class="xemthem" >
				   						<span >Xem Thêm</span>
				   					</div>
				   					<div class="anhsp" >
				   						<img src="img/trong4.jpg"	 alt="img/trong4.jpg" style="width: 100% ;height:100%">
				   					</div>

				   					<div class="in4sp">
				   						<div class="tensp">
					   						<span style="">Kawai ND-21</span>
					   					</div>
					   					<div class="price">
					   						<span class="giathat" >190.000₫</span>
					   						<span class="giagiam" >190.000₫</span>
					   					</div>
				   					</div>
				   				</div>
			   				</a>
			   			</div>   		
			   		</div>
	            </div>
	            <div class="carousel-item">
	                <div class="row"style="animation: moveBottom 1s ease-out;">
			   			<div class="col-lg-3 col-sm-6 col-12" >
			   				<a href=""  style="">
			   					<div class="giamgia-box" >
			   						<div class="timegiamgia" >
			   							<span >1d:2h:06p:32s</span>
			   						</div>
			   						<div  class="giamgia">
				   						<span style="font-size: 13px;">-20%</span>
				   					</div>
			   					</div>
				   				<div class="itemsp" >
				   					<div class="xemthem" >
				   						<span >Xem Thêm</span>
				   					</div>
				   					<div class="anhsp" >
				   						<img src="img/dan1.jpg"	 alt="img/dan1.jpg" style="width: 100% ;height:100%">
				   					</div>

				   					<div class="in4sp">
				   						<div class="tensp">
					   						<span style="">Kawai ND-21</span>
					   					</div>
					   					<div class="price">
					   						<span class="giathat" >190.000₫</span>
					   						<span class="giagiam" >190.000₫</span>
					   					</div>
				   					</div>
				   				</div>
			   				</a>
			   			</div>
			   			<div class="col-lg-3 col-sm-6 col-12" >
			   				<a href=""  style="">
			   					<div class="giamgia-box" >
			   						<div class="timegiamgia" >
			   							<span >1d:2h:06p:32s</span>
			   						</div>
			   						<div  class="giamgia">
				   						<span style="font-size: 13px;">-20%</span>
				   					</div>
			   					</div>
				   				<div class="itemsp" >
				   					<div class="xemthem" >
				   						<span >Xem Thêm</span>
				   					</div>
				   					<div class="anhsp" >
				   						<img src="img/dan10.jpg" alt="img/dan10.jpg" style="width: 100% ;height:100%">
				   					</div>

				   					<div class="in4sp">
				   						<div class="tensp">
					   						<span style="">Kawai ND-21</span>
					   					</div>
					   					<div class="price">
					   						<span class="giathat" >190.000₫</span>
					   						<span class="giagiam" >190.000₫</span>
					   					</div>
				   					</div>
				   				</div>
			   				</a>
			   			</div>
			   			<div class="col-lg-3 col-sm-6 col-12" >
			   				<a href=""  style="">
			   					<div class="giamgia-box" >
			   						<div class="timegiamgia" >
			   							<span >1d:2h:06p:32s</span>
			   						</div>
			   						<div  class="giamgia">
				   						<span style="font-size: 13px;">-20%</span>
				   					</div>
			   					</div>
				   				<div class="itemsp" >
				   					<div class="xemthem" >
				   						<span >Xem Thêm</span>
				   					</div>
				   					<div class="anhsp" >
				   						<img src="img/saxophone7.jpg"	 alt="img/saxophone7.jpg" style="width: 100% ;height:100%">
				   					</div>

				   					<div class="in4sp">
				   						<div class="tensp">
					   						<span style="">Kawai ND-21</span>
					   					</div>
					   					<div class="price">
					   						<span class="giathat" >190.000₫</span>
					   						<span class="giagiam" >190.000₫</span>
					   					</div>
				   					</div>
				   				</div>
			   				</a>
			   			</div>
			   			<div class="col-lg-3 col-sm-6 col-12" >
			   				<a href=""  style="">
			   					<div class="giamgia-box" >
			   						<div class="timegiamgia" >
			   							<span >1d:2h:06p:32s</span>
			   						</div>
			   						<div  class="giamgia">
				   						<span style="font-size: 13px;">-20%</span>
				   					</div>
			   					</div>
				   				<div class="itemsp" >
				   					<div class="xemthem" >
				   						<span >Xem Thêm</span>
				   					</div>
				   					<div class="anhsp" >
				   						<img src="img/trong4.jpg"	 alt="img/trong4.jpg" style="width: 100% ;height:100%">
				   					</div>

				   					<div class="in4sp">
				   						<div class="tensp">
					   						<span style="">Kawai ND-21</span>
					   					</div>
					   					<div class="price">
					   						<span class="giathat" >190.000₫</span>
					   						<span class="giagiam" >190.000₫</span>
					   					</div>
				   					</div>
				   				</div>
			   				</a>
			   			</div>   		
			   		</div>
	            </div>
	        </div>
	         <a class="carousel-control-prev" href="#demo3" style="position: absolute;left: -100px;width: 50px;height: 50px;top:150px;" data-slide="prev">
	            <span style="background-color: #00000054;padding: 15px;border-radius: 10px;" class="carousel-control-prev-icon"></span>
	        </a>
	        <a class="carousel-control-next" style="position: absolute;right: -100px;width: 50px;height: 50px;top:150px;" href="#demo3" data-slide="next">
	            <span style="background-color: #00000054;padding: 15px;border-radius: 10px;" class="carousel-control-next-icon"></span>
	        </a>
	    </div>
   		
   		<div class="row" style="margin-top: 20px;animation: moveBottom 1s ease-out;margin-bottom: 10px;">
   			<div class="col-12">
   				<a class="btn btn-white" href="sanpham.php">Xem Thêm</a>
   			</div>
   		</div>
   	</div>
   	<div style="clear: both;"></div>
   	<?php require_once("footer.php") ?>
   	<div style="clear: both;"></div>
   	
</body>
</html>
   