<?php
	$verifi = "";
	$notify = "";
	$mail_to = isset($_POST['email'])?$_POST['email']:"";
	$mail_tieude = "[NHACCUVIET] Email Xác Nhận";
	$mail_noidung = rand(1000,9999);
	$verifi = $mail_noidung;
	$headers = "From: sender\'s email";
	if($mail_to!="")
	{
		if(mail($mail_to, $mail_tieude, $mail_noidung,$headers)==true)
		{
			$notify = "thành công";
		}
		else
		{
			$notify = "thất bại";
		}
	}
	else
	{
		$notify = "Chưa nhập mail";
	}
?>
<?php echo $notify."\n"; echo $verifi."\n"; echo $mail_to."\n"; echo $mail_tieude; ?>

