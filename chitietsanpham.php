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
    $idsp = isset($_REQUEST['idsp'])?$_REQUEST['idsp']:'';
    $sql = "select * from product where id = '$idsp'";
    $data = select_one($sql);
    $lienquan = $data['category'];
    $sql2 = "select * from product where category = '$lienquan' limit 4;";
    $data2= select_list($sql2);
    
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
    <link rel="stylesheet" type="text/css" href="css/chitietsanpham.css">
</head>
<body>
	<style type="text/css">
		input:focus{
			border: 0px;
		}
	</style>
	<script type="text/javascript">
		function ctsp_ctsp()
		{
			if(document.getElementById("ctsp_ct_conten").style.display == "none")
			{
				document.getElementById("ctsp_ct_conten").style.display = "block";
				document.getElementById("ctsp_icon").className = "fas fa-minus";
			}
			else
			{
				document.getElementById("ctsp_ct_conten").style.display = "none";
				document.getElementById("ctsp_icon").className = "fas fa-plus";
			}
		}
		function sao1()
		{
			document.getElementById("sao1").style.color = "#ffc312";
			document.getElementById("sao2").style.color = "#777777";
			document.getElementById("sao3").style.color = "#777777";
			document.getElementById("sao4").style.color = "#777777";
			document.getElementById("sao5").style.color = "#777777";
			document.getElementById("thangdiem").innerHTML  = "1/5";
		}
		function sao2()
		{
			document.getElementById("sao1").style.color = "#ffc312";
			document.getElementById("sao2").style.color = "#ffc312";
			document.getElementById("sao3").style.color = "#777777";
			document.getElementById("sao4").style.color = "#777777";
			document.getElementById("sao5").style.color = "#777777";
			document.getElementById("thangdiem").innerHTML  = "2/5";
		}
		function sao3()
		{
			document.getElementById("sao1").style.color = "#ffc312";
			document.getElementById("sao2").style.color = "#ffc312";
			document.getElementById("sao3").style.color = "#ffc312";
			document.getElementById("sao4").style.color = "#777777";
			document.getElementById("sao5").style.color = "#777777";
			document.getElementById("thangdiem").innerHTML  = "3/5";
		}
		function sao4()
		{
			document.getElementById("sao1").style.color = "#ffc312";
			document.getElementById("sao2").style.color = "#ffc312";
			document.getElementById("sao3").style.color = "#ffc312";
			document.getElementById("sao4").style.color = "#ffc312";
			document.getElementById("sao5").style.color = "#777777";
			document.getElementById("thangdiem").innerHTML  = "4/5";
		}
		function sao5()
		{
			document.getElementById("sao1").style.color = "#ffc312";
			document.getElementById("sao2").style.color = "#ffc312";
			document.getElementById("sao3").style.color = "#ffc312";
			document.getElementById("sao4").style.color = "#ffc312";
			document.getElementById("sao5").style.color = "#ffc312";
			document.getElementById("thangdiem").innerHTML  = "5/5";
		}
		function tongtien()
		{
			var solg = document.getElementById("soluongdatmua").value;
			var allt = solg * "<?php echo $data['price']?>";

			document.getElementById("tongtien").innerHTML = allt +"₫" ;
		}
		function themgiohang(idkh,idsp)
		{
			var solg = document.getElementById("soluongdatmua").value;
			if(solg>0)
			{
				$.post('backend/themgiohang.php',{'idkh':idkh,'idsp':idsp,'amount':solg},function(data)
				{
					if(data!="")
					{
						alert(data);
					}
					else
					{
						location.reload();
					}
				});
			}
			else
			{
				alert("Bạn chưa chọn số lượng");
			}
		}
		function chualogin()
		{
			alert("Bạn chưa đăng nhập");
		}
	</script>
	<?php require_once('header.php') ?>
	<div class="container-fluid" style="height: 100px;"></div>	
	<div class="container-fluid" style="margin-top: 50px; margin-bottom: 50px;">
		<div style="position: absolute;z-index: 100;top:100px;left: 95px;" ><ul>
			<li style="padding-right: 10px;animation: moveInLeft 1s ease-out;"><a href="Home.php" style="padding-right: 10px;border-right: 1px solid #231f;color: #231f;">Trang Chủ</a></li>
			<li style="padding-right: 10px;animation: moveInLeft 1s ease-out;"><a href="sanpham.php?theloai=<?php echo $data['category']; ?>" style="padding-right: 10px;border-right: 1px solid #231f;color: #231f;"><?php echo $data['category']; ?></a></li>
			<li style="animation: moveInLeft 1s ease-out;"><a href="#" style="color: #feaf37;"><?php echo $data['name']; ?></a></li>
		</ul></div>
		<div class="row">
			<div class="col-5">
				<div class="ctsp_img" style="width: 80%;margin: auto;margin-left: 15%;height: 500px; margin-top: 40px; ">
					<img src="<?php echo $data['avatar']; ?>" alt="<?php echo $data['avatar']; ?>" style="width: 100%;height: 100%;animation: nhaylennhaylen .5s ease-out;animation: baylennaoa 2s infinite">
				</div>
				<div class="ctsp_shadow" style="width: 60%;margin: auto;margin-left: 25%; animation: baylennaob 2s infinite;
				background-image: radial-gradient(gray, #eee0);height: 70px;border-radius: 100px;clip-path: ellipse(49% 18% at 50% 50%);">
					
				</div>
			</div>
			<div class="col-7">
				<div class="ctsp_item" style="border-bottom: 1px solid black;width: 85%;margin-left: 10%;">
					
					<div class="ctsp_item_top" style="width: 100%;height: 80px;border-bottom: 1px solid #feaf37;animation: moveBottom 1s ease-out;">
						<p style="color: #231f20; text-transform: uppercase; font-weight: bold;font-size: 30px;letter-spacing: 4px;margin-left: 10px;margin-bottom: 0px;width: 100%;"><?php echo $data['name']; ?></p>
						<span style="color: #231f20;margin-left: 10px;font-size: 12px;">Thể Loại : <?php echo $data['category']; ?></span>
					</div>
					<div class="ctsp_item_body">
						
							<div class="ctsp_price" style="margin-top: 20px;">
								<p style="color: #231f20;font-size: 18px;margin-left: 10px;text-transform: uppercase;">Giá :</p>
								<span style="margin-left: 10px;font-size: 20px;padding-top: 10px; color: #f23333;"><?php echo number_format($data['price']); ?>₫</span>
								<span style="margin-left: 10px;font-size: 18px;padding-top: 10px;text-decoration: line-through;">150.000.000₫</span>
							</div>
							<div class="ctsp_price" style="margin-top: 40px;">
								<p style="color: #231f20;font-size: 18px;margin-left: 10px;text-transform: uppercase;">Số Lượng :</p>
								<input id="soluongdatmua"  style="margin-left: 10px;font-size: 15px; color: #231f20;text-align: center;width: 100px;" onchange="tongtien()" value="0" min="0" max="<?php echo $data['total']; ?>" type="number" name="">
							</div>
							<div class="ctsp_mota" style="margin-top: 40px;">
								<p style="color: #231f20;font-size: 18px;margin-left: 10px;text-transform: uppercase;">Mô Tả Sản Phẩm :</p>
								<div class="ctsp_text" style="width: 85%;margin-top: -10px;margin-left: 10px;">
									<span style="margin-left: 10px;font-size: 15px; color: #231f20"><?php echo $data['description']; ?></span>
								</div>

							</div>
							<div class="ctsp_tinhtrang" style="margin-top: 40px;">
								<p style="margin-bottom: 5px;">Tình Trạng :</p>
								<span style="margin-left: 10px;font-size: 15px; color: #231f20;margin-top: -10px;"><?php if($data['total']>0){echo "Còn hàng";}else{echo "Hết hàng";} ?></span>
							</div>
							<div class="ctsp_tinhtrang" style="margin-top: 40px;">
								<p style="margin-bottom: 5px;">Tổng Tiền :</p>
								<span id="tongtien" style="margin-left: 10px;font-size: 20px; color: #f23333;margin-top: -10px;">0₫</span>
							</div>
							<div class="ctsp_uudai" style="width: 100%; border: 1px dashed #777777;height: 150px;border-radius: 10px;margin-top: 40px;animation: moveInLeft 1s ease-out;">
								<div class="ctsp_uudau_card" style="margin-top: 15px;">
									<span style="color: #545152;font-size: 15px; " ><i class="fas fa-shipping-fast"></i><span style="font-weight: bold;font-size: 16px; margin-left: 5px;"> MIỄN PHÍ VẬN CHUYỂN </span>cho đơn hàng từ 20.000.000đ</span>
								</div>
								<div class="ctsp_uudau_card">
									<span style="color: #545152;font-size: 15px; " ><i class="fas fa-undo"></i><span style="font-weight: bold;font-size: 16px;margin-left: 5px; "> HOÀN TIỀN 100% </span>cho các sản phẩm không đúng với đơn hàng.</span>
								</div>
								<div class="ctsp_uudau_card">
									<span style="color: #545152;font-size: 15px; " ><i class="fas fa-money-check-alt"></i><span style="font-weight: bold;font-size: 16px; margin-left: 5px;">KIỂM TRA HÀNG TRƯỚC KHI THANH TOÁN</span></span>
								</div>
								<div class="ctsp_uudau_card">
									<span style="color: #545152;font-size: 15px; " ><i class="fas fa-exchange-alt"></i><span style="font-weight: bold;font-size: 16px; margin-left: 5px;"> MIỄN PHÍ ĐỔI TRẢ </span>trong vòng 15 ngày kể từ ngày mua hàng.</span>
								</div>
							</div>
							<button type="button" onclick="<?php if($id!=""){echo "themgiohang('KH".$id."',".$idsp.")";}else{ echo "chualogin()";}?>"  style="padding: 10px; padding-left: 50px;padding-right: 50px;text-align: center;background-color: #231f20;color: #fff;border-radius: 4px;margin-top: 20px;margin-bottom: 20px;margin-left: 50px;animation: nhaylennhaylen .5s ease-out;">Thêm Vào Giỏ Hàng</button>
						
					</div>	
				</div>
				<div class="ctsp_chitiet" style="border-bottom: 1px solid black;width: 85%;margin-left: 10%;">
					<button onclick="ctsp_ctsp()" type="button" style="width: 100%; padding: 10px;border: 0px;background-color: #fff;text-transform: uppercase;font-weight: bold;color: #231f20;text-align: left;padding-left: 100px;">Chi Tiết Sản Phẩm<i id="ctsp_icon" style="margin-left: 350px;" class="fas fa-plus"></i></button>
					<div id="ctsp_ct_conten"  class="ctsp_ct_conten" style="border-top: 1px solid black;padding-top: 20px;padding-bottom: 20px; display: none;animation: moveTop 0.3s ease-out;">
						<span style="padding-top: 10px;"><?php echo $data['detail']; ?></span>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="container danhgiasanpham" style="margin-top: 50px;  " >
		<p style="font-size: 25px;color:#231f;width: 100%; ">Đánh giá - Bình luận</p>
		<div class="row" style="width: 100%;">
			<div class="col-7">
				<div class="ctsp_comment" style="width: 90%; height: 500px;padding-top: 50px;">
					<div class="ctsp_comment_top" style="overflow: auto;height: 300px;width: 100%;">
						<div class="ctsp_comment_left">
							<div class="ctsp_comment_img" style="width: 40px;height: 40px;float: left;">
								<img src="" alt="" style="width: 100%;height: 100%">
							</div>
							<div class="ctsp_comment_conten" style="margin-left: 40px;width: 500px;
							clip-path: polygon(2% 0, 100% 0%, 100% 100%, 2% 100%, 0% 50%);" >
								<p style="margin-left: 10px; font-size: 13px;padding-left: 10px;padding-bottom: 0px;word-wrap: break-word;color: #777777;margin-bottom: 0px;">Phím đàn với độ nhạy và độ chính xác cao giúp cải thiện kĩ năng của trẻ.
									Được trang bị ba bàn đạp để chơi những giai điệu cổ điển một cách chuẩn xác.</p>
								<span style="margin-left: 10px; font-size: 11px;padding: 10px;">10:35</span>
							</div>
						</div>
						<div class="ctsp_comment_right">
							<div class="ctsp_comment_img" style="width: 40px;height: 40px;float: right;">
								<img src="" alt="" style="width: 100%;height: 100%">
							</div>
							<div class="ctsp_comment_conten" style="width: 500px;float: right;">
								<p style=" text-align: right; font-size: 13px;padding-bottom: 0px;word-wrap: break-word;color: #777777;margin-bottom: 5px; width: 100%;padding-right:10px; ">Phím đàn với độ nhạy và độ chính xác cao giúp cải thiện kĩ năng của trẻ.
									Được trang bị ba bàn đạp để chơi những giai điệu cổ điển một cách chuẩn xác.</p>
								<p style="text-align: right; font-size: 11px;color: #777777;padding-top: 5px">10:35</p>
							</div>
						</div>
					</div>
					<div class="ctsp_comment_bottom">
						<textarea class="form-control" style="width: 100%;padding: 10px;max-height: 140px;min-height: 50px;" placeholder="Viết bình luận của bạn..." ></textarea>
							<button type="button" style="font-size: 13px;padding: 5px; padding-left: 50px;padding-right: 50px;text-align: center;background-color: #231f20;color: #fff;border-radius: 4px;margin-top: 20px;margin-bottom: 20px;margin-left:0px;animation: nhaylennhaylen .5s ease-out;">Gửi bình luận</button>
					</div>
				</div>				
			</div>
			<div class="col-5">
				<div class="ctsp_danhgia">
					<h2 style="color: #000;">Đánh giá sản phẩm</h2>
					<ul style="margin-top: 50px;">
						<li style="width: 100%;">5 :  
							<label for="checkbox">
								<i style="color: #ffc312" class="fas fa-star"></i>
								<i style="color: #ffc312" class="fas fa-star"></i>
								<i style="color: #ffc312" class="fas fa-star"></i>
								<i style="color: #ffc312" class="fas fa-star"></i>
								<i style="color: #ffc312" class="fas fa-star"></i>
								(rất hài lòng)
							</label>
							<input style="display: none;" id="checkbox" type="checkbox" name="checkbox">
						</li>
						<li >4 :
							<label for="checkbox">
								<i style="color: #ffc312" class="fas fa-star"></i>
								<i style="color: #ffc312" class="fas fa-star"></i>
								<i style="color: #ffc312" class="fas fa-star"></i>
								<i style="color: #ffc312" class="fas fa-star"></i>
								<i class="fas fa-star"></i>
								(hài lòng)
							</label>
							<input style="display: none;" id="checkbox" type="checkbox" name="checkbox">
						</li>
						<li >3 :
							<label for="checkbox">
								<i style="color: #ffc312" class="fas fa-star"></i>
								<i style="color: #ffc312" class="fas fa-star"></i>
								<i style="color: #ffc312" class="fas fa-star"></i>
								<i class="fas fa-star"></i>
								<i class="fas fa-star"></i>
								(trung bình)
							</label>
							<input style="display: none;" id="checkbox" type="checkbox" name="checkbox">
						</li>
						<li >2 :
							<label for="checkbox">
								<i style="color: #ffc312" class="fas fa-star"></i>
								<i style="color: #ffc312" class="fas fa-star"></i>
								<i class="fas fa-star"></i>
								<i class="fas fa-star"></i>
								<i class="fas fa-star"></i>
								(tệ)
							</label>
							<input style="display: none;" id="checkbox" type="checkbox" name="checkbox">
						</li>
						<li >1 :
							<label for="checkbox">
								<i style="color: #ffc312" class="fas fa-star"></i>
								<i class="fas fa-star"></i>
								<i class="fas fa-star"></i>
								<i class="fas fa-star"></i>
								<i class="fas fa-star"></i>
								(rất tệ)
							</label>
							<input style="display: none;" id="checkbox" type="checkbox" name="checkbox">
						</li>
					</ul>
				</div>
				<div>
					<h1 id="thangdiem" style="font-size: 50px;color: #cb1c22;margin-left: 50px;">1/5</h1>
					<i onclick="sao1()" id="sao1" style="font-size: 30px;color: #ffc312" class="fas fa-star"></i>
					<i onclick="sao2()" id="sao2" style="font-size: 30px;" class="fas fa-star"></i>
					<i onclick="sao3()" id="sao3" style="font-size: 30px;" class="fas fa-star"></i>
					<i onclick="sao4()" id="sao4" style="font-size: 30px;" class="fas fa-star"></i>
					<i onclick="sao5()" id="sao5" style="font-size: 30px;" class="fas fa-star"></i>
				</div>
			</div>
		</div>
	</div>
	<div class="container uudai" style="margin-bottom: 50px;">
   		<div class="title" style="position: relative;top: -17px;left: 350px;background-color: #fff;width: 360px; text-align: center;">
   			
   			<h3 style="font-weight: bold;color: #000000cc;">SẢN PHẨM Liên Quan</h3>
   		</div>
   		<div class="row"style="animation: moveBottom 1s ease-out;">
   			<?php
   			foreach ($data2 as $key) 
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
	<?php require_once('footer.php') ?>
</body>
</html>