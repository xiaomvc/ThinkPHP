<?php

//发送邮件
function sendEmail($to, $title, $content)
{
    require_once('./Tools/phpMailer/PHPMailer.php');
    require_once('./Tools/PHPMailer/Smtp.php');
    $mail = new PHPMailer();

    // 设置为要发邮件
    $mail->IsSMTP();
    // 是否允许发送HTML代码做为邮件的内容
    $mail->IsHTML(TRUE);
    $mail->CharSet = 'UTF-8';
    // 是否需要身份验证
    $mail->SMTPAuth = TRUE;
    /*  邮件服务器上的账号是什么 -> 到163注册一个账号即可 */
    $mail->From = "13542902370@163.com";
    $mail->FromName = "李卓楷";
    $mail->Host = "smtp.163.com";  //发送邮件的服务协议地址
    $mail->Username = "李卓楷";
    $mail->Password = "13542902370QWE";
    //$mail->SMTPSecure= "SSL";

    // 发邮件端口号默认25/465
    $mail->Port = 25;
    // 收件人
    $mail->AddAddress($to);
    // 邮件标题
    $mail->Subject = $title;
    // 邮件内容
    $mail->Body = $content;

    if ($mail->Send()) {

        return true;
    } else {

        $mail->ErrorInfo();
    }
}