<?php
/**
 * Created by PhpStorm.
 * User: shoujiafeng
 * Date: 25/04/2017
 * Time: 12:37 AM
 */
include 'method/smtp.php';
include 'method/variable.php';
include_once 'method/DES.php';

$mail = $_REQUEST["email"];
$des = new DES("1996");

$encrypt_mail = $des->passport_encrypt($mail);
sendMail($mail,"Liverpool Dock account password forget",$baseUrl."View/reset.html?secret=".urlencode($encrypt_mail));
?>