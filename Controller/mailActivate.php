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
require_once "method/fileHandler.php";
require_once "method/variable.php";

$encrypt_mail = $_REQUEST["secret"];
$des = new DES("1996");
$dao = getQuery("User");

$mail = $des->passport_decrypt($encrypt_mail);
$result = $dao->update(array("is_active"=>1),array("email"=>$mail));
$dao->table("User_profile");
$dao->insert(array("email"=>$mail));


if($result){
    echo "activate success";
    makedir($mail,$repositoryUrl);
}else{
    echo "The account has been activated";
}

?>