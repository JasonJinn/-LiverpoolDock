<?php
/**
 * Created by PhpStorm.
 * User: shoujiafeng
 * Date: 2017/4/3
 * Time: 下午7:55
 */
include '../DAO/Database.php';
include 'method/DES.php';
include "method/variable.php";

$token = $_COOKIE["token"];
$dao = getQuery("User");
$des = new DES("1996");

$email=explode( '^&*',($des->passport_decrypt($token)))[0];

//echo $email;
$cnt = $dao->update(array("token"=>"NULL"),array("email"=>$email));
setcookie("token","",time()-1800,"/",$domain);
setcookie("mail","",time()-1800,"/",$domain);

if($cnt){
    header("../View/login.html");
}
?>