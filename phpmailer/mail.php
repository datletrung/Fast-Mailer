<?php
    require('class.smtp.php');
    require('class.phpmailer.php');
    $nFrom = "OceanName";    //company name
    $mFrom = 'oceannamedomain@gmail.com';  //email address 
    $mPass = 'Tatdat0922';       //email password
    $nTo = $_GET['username']; //Ten nguoi nhan
    $mTo = $_GET['email'];   //Dia chi nhan mail
    $body = $_GET['body'];   // Noi dung email
    $title = $_GET['title'];   //Tieu de email
	
	//echo $nTo,$mTo,$body,$title;
	
    $mail = new PHPMailer();
    $mail->IsSMTP();             
    $mail->CharSet  = "utf-8";
    $mail->SMTPDebug  = 0;   
    $mail->SMTPAuth   = true; 
    $mail->SMTPSecure = "ssl"; 
    $mail->Host       = "smtp.gmail.com";   
    $mail->Port       = 465;       
	
    $mail->Username   = $mFrom;
    $mail->Password   = $mPass;           
    $mail->SetFrom($mFrom, $nFrom);
    $mail->AddReplyTo('letrungcaotung@gmail.com', 'OceanName');
    $mail->Subject = $title;
    $mail->MsgHTML($body);
    $mail->AddAddress($mTo, $nTo);
	
    if(!$mail->Send()){
        echo "fail";
    }else{
        echo "success";
    }
?>
