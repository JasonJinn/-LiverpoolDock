<?php
/**
 * Created by PhpStorm.
 * User: shoujiafeng
 * Date: 2017/4/3
 * Time: 下午7:56
 */
include "method/DES.php";
include "../DAO/Database.php";
require_once "method/variable.php";

$encrypt_mail = $_GET["secret"];                    //ps. need urlencode for this parameter
//$old = $_REQUEST["old"];
$new = $_REQUEST["new"];
$des = new DES("1996");
$dao = getQuery("User");

$mail = $des->passport_decrypt($encrypt_mail);
//echo $mail;
$dao = getQuery("User");

$result = $dao->update(array("password"=>$new),array("email"=>$mail));

if($result==1){
    echo "change password success";
}else{
    echo "change fail";
}

?>