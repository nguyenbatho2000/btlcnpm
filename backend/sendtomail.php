
<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    $title = "[NHACCUVIET] Email Xác Minh";
    $codeveri = rand(1000,9999);
    $noidung = '
    <div style="width: 400px; height: 500px; border: 1px solid black;position: absolute;top: 10%;left:35%;border-radius: 10px;background-color:black; ">
        <div style="width: 100%;height: 80px;border-bottom: 1px solid gray;">
            <div style=" width: 60%;margin: auto;height: 100%;">
                <a href="http://localhost/BTL_CNPM/nhaccuviet.html" style="text-decoration: none;">
                <img style="width: 70px;height: 70px;float: left;margin-top: 5px;" src="https://lh3.googleusercontent.com/KTO_zy1_Xu0FJWes94yjlbCn16vx4Rj60oP-DtpCZRo0EPXLJkjN6ED14UPnDFy2o3eH9uCmf21DPd5tIZ-HFHZ826gfPZC6sBhrteYABrSwq3rAQ0gvrzWRXtfCO8n5IUoNL2z0NL9pUKLCdM7XkcpxHnKQadeKHwmiPEprw3_51GipWC1nbK6iez4vm5nhBqvFLKE3M6dcJ6HUmPxCXoQBbHCnTJ1eza6pWKC-jbTSjYDjjLHul97qSjDEUCEoOBkd7uOXpET09m_Y814i7H59fYp5f14sPmzImI6hRFws26pBsCBQ-zplp8SWXlAO2NIYrG7kbKzkI--er6ivnX15oBP0eBHILiu4noYGseZ8K5YaVdClVU_4IBRcRwLRgTmAyrfImL4OhdrwTRqpVaVHRlEbu6lWNhQMJR8s2kJHJIJCiPnkN60wxigbvGYLDvO0WnPdOWIYkbu3KnoMVITMWn6gf8rsrTkvjMIL-1fJ9jzpceSyzyr5QKPcZu5QpDsWhmhE3S3pSeylcTqOcY_d-E9pphSBkmZB1wh07vJAQJjjrxJ9VJjTf5tY2juOfvFdrQZBM4gQJ9adxHlVwhiUUcGzkYmYCQPafABh1VNPTtKy5SBqXuzrp6shcV48laG6VTUD9GOwWdFPXBXLqZRJqj_0Rt6zv6UGBsA-xj_RWEYYn_0Xr9NlVJAIbg=s697-no?authuser=0" >
                <span style="font-family: Brush Script MT;font-weight: bold;text-shadow: -1px 2px 0px grey;color: #fff;font-size: 40px;margin-bottom:-20px;position: absolute;top: 20px;animation: moveTop 1s ease-out;">NhacCuViet</span>
                </a>
            </div>
            <div>
                <div style="width: 80% ; margin: auto;height: 419px;">
                    <h2 style="color: #fff;width: 100px;font-size: 30px;font-weight: bold;width: 100%;text-align: center;margin-bottom: 10px;animation: moveInLeft 1s ease-out;">Email Xác Minh</h2>
                    <span style="padding: 10px;color: #fff; animation: moveInRight 1s ease-out;">Chào mừng bạn đến với Nhạc Cụ Việt shop bán hàng uy tín nổi trội cảm ơn bạn đã sử dụng dịch vụ của chúng tôi mã của bạn là :</span>
                    <p style="color: #fff;padding: 10px; padding-left: 15px;padding-right: 15px;border: 1px solid #fff; border-radius: 5px;text-align: center;width: 80px;margin: auto;margin-top: 40px;animation: moveInLeft 1s ease-out;">'.$codeveri.'</p>
                    <div style="width: 100%;height: 100px;"></div>
                    <span style="padding: 10px;color: #feaf37;font-size: 13px;text-align: center;margin-left: 30px;position: absolute;bottom: 10px;">Mọi thông tin liên hệ hãy liên hệ với chúng tôi.</span>
                </div>
            </div>
        </div>  
    </div>';
    
    if (empty($_POST['email'])) 
    { //Kiểm tra xem trường email có rỗng không?
        $error = "Bạn phải nhập địa chỉ email";
    } 
    elseif (!empty($_POST['email']) && !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) 
    {
        $error = "Bạn phải nhập email đúng định dạng";
    } 
    if (!isset($error)) 
    {
        include 'library.php'; // include the library file
        require 'vendor/autoload.php';
        $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
        try 
        {
            
            //Server settings
            $mail->CharSet = "UTF-8";
            $mail->SMTPDebug = 0;                                 // Enable verbose debug output
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = SMTP_HOST;  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = SMTP_UNAME;                 // SMTP username
            $mail->Password = SMTP_PWORD;                           // SMTP password
            $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = SMTP_PORT;                                    // TCP port to connect to
            //Recipients
            $mail->setFrom(SMTP_UNAME, "Tên người gửi");
            $mail->addAddress($_POST['email'], 'Tên người nhận');     // Add a recipient | name is option
            $mail->addReplyTo(SMTP_UNAME, 'Tên người trả lời');
//          $mail->addCC('CCemail@gmail.com');
//          $mail->addBCC('BCCemail@gmail.com');
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $title;
            $mail->Body = $noidung;
            $mail->AltBody = $noidung; //None HTML
            $result = $mail->send();
            if (!$result) 
            {
                $error = "Có lỗi xảy ra trong quá trình gửi mail";
            }
        } 
        catch (Exception $e) 
        {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }
    }
    if(!isset($error))
    {
        echo md5($codeveri);

    }
    else
    {
        echo "Thất Bại";
    }
    
?>


