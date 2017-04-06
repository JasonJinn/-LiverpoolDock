<?php
/**
 * Created by PhpStorm.
 * User: shoujiafeng
 * Date: 06/04/2017
 * Time: 9:42 PM
 */
include "method/smtp.php";

$smtpserver = "ssl://smtp.gmail.com";

$smtpserverport = 465;

$smtpusermail = "LiverpoolDock@gmail.com";

$smtpemailto = "xxx@xx.com";

$smtpuser = "LiverpoolDock@gmail.com";
$smtppass = "tricycle15";

$isauth = true;

$mailtype = "TXT";

$mailsubject = "hello";

$mailbody = "I am jeffer";


$smtp = new smtp($smtpserver, $smtpserverport, $isauth, $smtpuser, $smtppass);


$smtp->debug = false;


$smtp->sendmail($smtpemailto, $smtpusermail, $mailsubject, $mailbody, $mailtype);

echo "mail sent";
?>