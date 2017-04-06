<?php
/**
 * Created by PhpStorm.
 * User: shoujiafeng
 * Date: 06/04/2017
 * Time: 11:24 PM
 */
include "method/DES.php";
require "method/smtp.php";
include "../DAO/Database.php";

$encrypt_mail = $_GET["secret"];
$des = new DES("1996");
$dao = getQuery("User");

$mail = $des->passport_decrypt($encrypt_mail);
$result = $dao->update(array("is_active"=>1),array("email"=>$mail));
echo $result;
?>