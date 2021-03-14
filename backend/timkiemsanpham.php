<?php
    include('../lib_db.php');
    $search = $_POST['search'];
    if($search != "")
    {
      $sql = "select * from product where name like '%$search%'";
      $data = select_list($sql);
      if($data != "")
      {
      ?>
        
        <div class="iteamserch_box" style="width: 230px;max-height: 250px;background-color: #fff;margin-left: 10px;border-radius: 1px 1px 5px 5px;box-shadow: 0px 3px 5px 1px #feaf3747;overflow: auto;animation: cuon 1s ease-out;">
            <?php
            foreach ($data as $key) 
            {
                ?>
                <a href="chitietsanpham.php?idsp=<?php echo $key['id']; ?>">
                  <div class="iteamserch" style="width: 100%;height: 50px;background-color: #fff;border-bottom: 1px solid black;;border-radius: 5px;">
                      <div class="iteamserch_img" style="width: 50px;height: 49px;margin-left: 10px;float: left;">
                          <img src="<?php echo $key['avatar']; ?>" style="width: 100%;height: 100%;">
                      </div>
                      <div class="iteamserch_tt" style="margin-left: 10px;float: left;width: 140px;">
                        <h2 style="font-size: 13px;color: #000;margin-top: 4px;white-space: nowrap;width: 50px;text-overflow: clip;"><?php echo $key['name']; ?></h2>
                        <h2 style="font-size: 13px;color: #f23333;margin-top: 4px;"><?php echo number_format($key['price']); ?>₫</h2>
                      </div>
                  </div>
                </a>
                <?php
            }
            ?>
            
            <a href="timkiemtoansanpham.php?khoa=<?php echo $search; ?>" style="font-size: 13px;background-color: #feaf37;width: 100%;padding-left: 70px;padding-right: 70px;padding-top: 5px;padding-bottom: 5px;margin: auto;margin-left: 10px;border-radius: 5px;margin-bottom: 10px;">Xem tất cả</a>
        </div>
      <?php
      }
      else
      {
        echo "";
      }
    }
    else
    {
      echo "";
    }
    ?>