<?php
	include('../lib_db.php');
	 $id = substr($_POST['id'],2);
	 $sql = "SELECT * FROM bill INNER JOIN product on bill.idsp = product.id WHERE bill.idkh = $id AND bill.status = 'TrongGio';";
	 $data = select_list($sql);

?>
		<script type="text/javascript">
			
			
		</script>
		<div class="box_iteamorder" style="position: absolute;z-index: 2000;width: 450px; top: 50px; right: -40px;background-color: #c0c0bb6e;overflow: auto;border-radius: 0px 0px 5px 5px;max-height: 350px; ">
		    <div class="row" style="width: 100%;padding: 0px;margin: 0px;">
		    	<?php
				foreach ($data as $key) 
				{
				?>
			      	<div style="width: 100%;margin-bottom: 5px;animation: moveTop 1s ease-out;">
			            <div class="iteamorder" style="height: 80px;width: 98%;background-color: #fff;margin: auto;">
			          		<div class="iteamorder_img" style="width: 75px;height: 75px;margin-left: 10px;float: left;">
			            		<img src="<?php echo $key['avatar'] ?>" style="height: 100%;width: 100%;">
			          		</div>
			          		<div class="iteamorder_infor" style="width: 150px;height: 80px;float: left;margin-left: 10px;">
			                    <h2 style="margin-left: 5px;font-size: 15px;color: #000;margin-top: 5px;"><?php echo $key['name'] ?></h2>
			                    <h2 style="margin-left: 5px;font-size: 12px;color: #000;margin-top: 25px;">x<?php echo $key['amount'] ?></h2>
			          		</div>
			              	<div class="iteamorder_price">
			                	<p style="color: #f23333;font-size: 20px;text-align: right;margin-right: 30px;margin-top: 0px;"><?php echo number_format($key['totalmoney']) ?>₫</p>
			                	<button type="button" style="float: right;font-size: 12px;margin-right:20px; background-color: #fdae37;border: 0px;padding: 5px;padding-left: 20px;padding-right: 20px;margin-top: -10px; " onclick="removehang(<?php echo $key['idhd']; ?>)">Xóa</button>
			                	<button type="button" style="float: right;font-size: 12px;margin-right:90px; background-color: #fdae37;border: 0px;padding: 5px;padding-left: 20px;padding-right: 20px;margin-top: -30px; "  onclick="dathang(<?php echo $key['idhd']; ?>)">Đặt hàng</button>
			              	</div>
			            </div>
			      	</div>
			    <?php
				}
				?>
		    </div>
		    <button onclick="closedgh()" style="width: 100%;height: 30px;margin-top: 10px;bottom: 0px;background-color: #fdae37;border: 0px;">Đóng</button>
		</div>
	

      