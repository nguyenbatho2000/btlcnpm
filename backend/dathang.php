<?php
	include('../lib_db.php');
	$idhd = $_POST['idhd'];
	$sql = "SELECT * FROM bill INNER JOIN product on bill.idsp = product.id WHERE bill.idhd = $idhd ;";
	$data = select_one($sql);
?>
<script type="text/javascript">
	
</script>

  <div class="iteamdat" style="position: absolute;width: 600px;height: 300px;background-color: #fff;top: 20%;left: 30%;border-radius: 5px; animation: zoomout 1s ease-out;">
      <div class="img" style="width: 200px;height: 200px;margin-left: 40px;margin-top: 20px;float: left;">
        <img src="<?php echo $data['avatar'] ?>" style="width: 100%;height: 100%;">
      </div>
      <div style="float: left;margin-top: 30px;margin-left: 30px;">
          <h2 style="margin-left: 5px;font-size: 25px;color: #000;margin-top: 5px;"><?php echo $data['name'] ?></h2>
          <h2 style="margin-left: 5px;font-size: 15px;color: #000;margin-top: 15px;">Số Lượng : <?php echo $data['amount'] ?></h2>
           <h2 style="margin-left: 5px;font-size: 15px;color: #000;margin-top: 25px;">Địa Chỉ : <?php echo $data['deliveryaddress'] ?></h2>
          <h2 style="margin-left: 5px;font-size: 15px;color: #000;margin-top: 25px;">Tổng Tiền : <span style="color: #f23333;"><?php echo number_format($data['totalmoney']); ?>₫</span></h2>

      </div>
      <div style="width: 100%;margin-top: 230px; ">
        <button style="font-size: 15px;margin-right:20px; background-color: #fdae37;border: 0px;padding: 5px;padding-left: 20px;padding-right: 20px;margin-left: 130px;" onclick="tienhanhdathang(<?php echo $idhd; ?>)">Tiếng hành đặt</button>
        <button style="font-size: 15px;margin-right:20px; background-color: #fdae37;border: 0px;padding: 5px;padding-left: 20px;padding-right: 20px;margin: auto;margin-left: 50px;"
        onclick="closedathang()">Hủy</button>
      </div>
  </div>
