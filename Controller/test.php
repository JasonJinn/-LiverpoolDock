<?php
/**
 * Created by PhpStorm.
 * User: shoujiafeng
 * Date: 06/04/2017
 * Time: 9:42 PM
 */
//include "method/smtp.php";
//
//$smtpserver = "ssl://smtp.mail.yahoo.com";
//
//$smtpserverport = 465;
//
//$smtpusermail = "LiverpoolDock@yahoo.com";
//
//$smtpemailto = "524867701@qq.com";
//
//$smtpuser = "LiverpoolDock@yahoo.com";
//$smtppass = "tricycle15";
//
//$isauth = true;
//
//$mailtype = "TXT";
//
//$mailsubject = "hello";
//
//$mailbody = "I am jeffer";
//
//
//$smtp = new smtp($smtpserver, $smtpserverport, $isauth, $smtpuser, $smtppass);
//
//
//$smtp->debug = false;
//
//
//$smtp->sendmail($smtpemailto, $smtpusermail, $mailsubject, $mailbody, $mailtype);
//
//echo "mail sent";
//include 'method/DES.php';
//include '../DAO/Database.php';
//
//$dao = getQuery('User');
//$result = $dao->get(array("token"=>"UmUMOVZhCwgHJwEoBTVVZVVoBmIGNlQzUm1SN19uDzM="));
//
//print_r(array_values($reuslt));
$html = file_get_contents("https://news.liverpool.ac.uk/");
preg_match("/<div id=\"container\">(.*?)<\/div>/s",$html,$qwe);
print_r($qwe);

preg_match_all("/<a href=\"(.*?)\" title=\"(.*?)\"/s",$qwe,$matches);
print_r($matches);
?>