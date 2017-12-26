<?php
/**
 * -------------邮件发送函数-----------------------
 *                                                *
 * $content         邮件内容 格式为 html 代码     *
 * $title           邮件标题                      *
 * $send_mail       发送邮件的邮箱                *
 * $send_password   发送邮件的邮箱密码            *
 * $send_name       发送邮件的人的姓名(或者说昵称)*
 * $to_mail            收件人的邮箱                  *
 * $result_mail        收件人回复的邮箱              *
 * $code            编码(默认为utf-8)             *
 *                                                  *
 * ------------------------------------------------
 **/
function sendMail($content, $title, $send_mail, $send_password, $send_name, $to_mail, $result_mail, $code = "utf-8")
{

    include_once("class.phpmailer.php");        // 引入php邮件类
    $mail = new PHPMailer();
    $mail->CharSet = $code;                    // 编码格式
    $mail->IsSMTP();
    $mail->SMTPAuth = true;                   // 必填，SMTP服务器是否需要验证，true为需要，false为不需要
    $mail->Host = "smtp.qq.com";         // 必填，设置SMTP服务器
    $mail->Port = 465;                     // 设置端口
    $mail->Username = $send_mail;            // 必填，开通SMTP服务的邮箱；任意一个163邮箱均可
    $mail->Password = $send_password;         // 必填， 以上邮箱对应的密码
    $mail->From = $send_mail;                // 必填，发件人Email
    $mail->FromName = $send_name;             // 必填，发件人昵称或姓名
    $mail->Subject = $title;                // 必填，邮件标题（主题）

    //可选，纯文本形势下用户看到的内容
    //$mail->AltBody    = "This is the body when user views in plain text format";
    //$mail->WordWrap   = 50; 				    // 自动换行的字数

    $mail->MsgHTML($content);
    $mail->AddReplyTo($result_mail);            // 收件人回复的邮箱地址
    $mail->AddAddress($to_mail);                // 收件人邮箱
    $mail->IsHTML(true);                        // 是否以HTML形式发送，如果不是，请删除此行
    if ($mail->Send()) {
        echo "123";
    } else {
        echo "失败";
    }

}

sendMail("测试", "info新", "643568695@qq.com", "imauirwvbnmgbbaj", "李卓楷", "13542902370@163.com", "643568695@qq.com", $code = "utf-8");

