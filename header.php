
<script type="text/javascript">
  function giohang(idkh)
  {
    $.post('backend/giohang.php',{'id':idkh},function(data)
    {
        document.getElementById('khachhang_giohang').innerHTML = data;  
    });
  }
  function closedgh()
   {
     document.getElementById('khachhang_giohang').innerHTML = "";
   }
   function tienhanhdathang(idhd)
  {
    console.log("davaoday");
    $.post('backend/capnhatdathang.php',{'idhd':idhd},function(data)
      {
        console.log(data);
        if(data == "")
        {
          closedathang();
          location.reload();
        }
      });

  }
  function closedathang()
  {
    document.getElementById('khachhang_dathang').innerHTML = "";
    document.getElementById('khachhang_dathang').style.display = "none";
  }
  function dathang(idhd)
  {
    document.getElementById('khachhang_dathang').style.display = "block";
     $.post('backend/dathang.php',{'idhd':idhd},function(data)
      { 
        document.getElementById('khachhang_dathang').innerHTML = data;
      });
  }
  function removehang(idhd)
  {
    var option = confirm("Bạn có muốn xóa không ?");
    if( option == true)
    {
      $.post('backend/removehang.php',{'idhd':idhd},function(data){location.reload();});
    }
  }
  function timkiemsp(search)
  {
      
      $.post('backend/timkiemsanpham.php',{'search':search},function(data)
      { 
          if(data != "")
          {
            document.getElementById("iteamserch").style.display = "block";
            document.getElementById("iteamserch").innerHTML = data; 
          }
          else
          {
            document.getElementById("iteamserch").style.display = "none";
          }
          
      })
  }
</script>

<style type="text/css">
  .iteamserch_box a .iteamserch{transition: 0.5s;}
  .iteamserch_box a:hover .iteamserch{
    transform: translateY(-2px);
    
    box-shadow: 0px 1px 10px 0.1px #ffc312;
  }
  .list-box ul li{
    margin: 0;
  }
  @keyframes cuon {
    0%{
      max-height: 0px;
      
    }
    100%{
      max-height: 250px;
    }
  }
</style>
<?php
  if(isset($_POST['tim']))
  {
    $khoa = $_POST['khoa'];
    header('location:timkiemtoansanpham.php?khoa='.$khoa.'');
  }
?>
<div id="header" class="header-top" >
    <div id="logo-box" class="logo-box">
        <a href="Home.php">
        	<img src="./img/logo.png" class="logo" alt="logo">
       		<h2 class="thuonghieu" style="">NhacCuViet</h2>
        </a>
    </div>
    <div id="search-box" class="search-box">
    	   <form method="POST" action="timkiemtoansanpham.php">
          	<input type="text" onkeyup="timkiemsp(this.value)" name="khoa" placeholder="  Tìm kiếm sản phẩm" style="text-align: center;float: left;border-radius: 50px 0px 0px 50px;border-right: 0px;height: 35px; animation: moveTop 1s ease-out;" >
          	<button name="tim" type="submit" style="border-radius: 0px 50px 50px 0px;border-left: 0px;background-color: #fff;height: 35px;animation: moveTop 1s ease-out; width: 50px;"><i class="fas fa-search"></i></button>
        </form>	
      <div id="iteamserch" style="position: absolute;z-index: 1000;display: none;">
          
      </div>
    </div>
  <nav id="navbartest" class=" navbar-expand-md">
      <button style="border: 1px solid black;background-color: #07070740;animation: moveTop 1s ease-out;" class="navbar-toggler" type="button" data-toggle="collapse" data-target="#okok">
          <i style="padding: 5px;" class="fas fa-list"></i>
      </button> 
      <div id="list-box" class="list-box collapse navbar-collapse" id="okok" style="">
      	<ul class="nabar-nav ml-auto">
        		<li class="nav-item"><a href="Home.php" class="list nav-link" >Trang Chủ</a></li>
        		<li class="nav-item"><a href="" class="list nav-link">Tin Tức</a></li>
        		<li class="nav-item"><a href="" class="list nav-link">Liên Hệ</a></li>
        		<li class="nav-item"><a href="<?php if($id != ""){echo "thongtinkhachhang.php";}else{echo "login.php";} ?>" class="list nav-link"><?php if($id != ""){echo $data1['fullname'];}else{echo "Đăng Nhập";} ?></a></li>
            <?php 
            if($id != "")
            {
            ?>
              <li class="nav-item"><form method="post"><button style="background-color: #00000000;border: 0px;" type="submit" name="logout" class="list nav-link">Đăng Xuất</button></form></li>
              <?php
            }
            ?>
      	</ul>
      </div>
  </nav>
 	<div id="giohang-box" class="giohang-box" >
   		<a href="#">
   			<img <?php if($id != ""){ $gh = "giohang('KH".$id."')"; echo 'onclick="'.$gh.'"';} ?> src="./img/giohang.png" class="giohang" alt="giohang"> 
        <?php 
        if( $id != "")
        {
          echo "<span>".$datasl['sl']."</span>";
        }
        ?>
   			
   		</a>
      <div id="khachhang_giohang" >
        <!-- <div class="box_iteamorder" style="position: absolute;z-index: 2000;width: 450px; top: 50px; right: -40px;background-color: #f2db44b5;border-radius: 0px 0px 5px 5px;max-height: 350px ;overflow: auto;">
            <div class="row" style="width: 100%;padding: 0px;margin: 0px;">
              <div style="width: 100%;margin-bottom: 5px;">
                <div class="iteamorder" style="height: 80px;width: 98%;background-color: #fff;margin: auto;">
                    <div class="iteamorder_img" style="width: 75px;height: 75px;margin-left: 10px;float: left;">
                      <img src="img/dan1.jpg" style="height: 100%;width: 100%;">
                    </div>
                    <div class="iteamorder_infor" style="width: 100px;height: 80px;float: left;margin-left: 10px;">
                      <h2 style="margin-left: 5px;font-size: 15px;color: #000;margin-top: 5px;">Kawai ND-21</h2>
                      <h2 style="margin-left: 5px;font-size: 12px;color: #000;margin-top: 25px;">x2</h2>
                    </div>
                    <div class="iteamorder_price">
                      <p style="color: #f23333;font-size: 20px;text-align: right;margin-right: 30px;margin-top: 0px;">104.300.000₫</p>
                      <button type="button" style="float: right;font-size: 12px;margin-right:20px; background-color: #fdae37;border: 0px;padding: 5px;padding-left: 20px;padding-right: 20px;margin-top: -10px;">Xóa</button>
                      <button type="button" style="float: right;font-size: 12px;margin-right:20px; background-color: #fdae37;border: 0px;padding: 5px;padding-left: 20px;padding-right: 20px;margin-top: -10px;">Đặt hàng</button>
                    </div>
                </div>
              </div>
              <div style="width: 100%;margin-bottom: 5px;">
                <div class="iteamorder" style="height: 80px;width: 98%;background-color: #fff;margin: auto;">
                    <div class="iteamorder_img" style="width: 75px;height: 75px;margin-left: 10px;float: left;">
                      <img src="img/dan1.jpg" style="height: 100%;width: 100%;">
                    </div>
                    <div class="iteamorder_infor" style="width: 100px;height: 80px;float: left;margin-left: 10px;">
                      <h2 style="margin-left: 5px;font-size: 15px;color: #000;margin-top: 5px;">Kawai ND-21</h2>
                      <h2 style="margin-left: 5px;font-size: 12px;color: #000;margin-top: 25px;">x2</h2>
                    </div>
                    <div class="iteamorder_price">
                      <p style="color: #f23333;font-size: 20px;text-align: right;margin-right: 30px;margin-top: 0px;">104.300.000₫</p>
                      <button type="button" style="float: right;font-size: 12px;margin-right:20px; background-color: #fdae37;border: 0px;padding: 5px;padding-left: 20px;padding-right: 20px;margin-top: -10px;">Xóa</button>
                      <button type="button" style="float: right;font-size: 12px;margin-right:20px; background-color: #fdae37;border: 0px;padding: 5px;padding-left: 20px;padding-right: 20px;margin-top: -10px;">Đặt hàng</button>
                    </div>
                </div>
              </div>

            </div>
          <button style="width: 100%;height: 30px;margin-top: 10px;bottom: 0px;background-color: #fdae37;border: ">Đóng</button> -->
        </div>
       
      </div>
      
 	</div>
</div>
<div id="khachhang_dathang" class="dathang" style="width: 100%; height: 100%;background-color: #00000054;z-index: 10000;position: fixed; display: none;">

</div>