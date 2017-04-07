<?php
/**
 * Created by PhpStorm.
 * User: shoujiafeng
 * Date: 2017/4/3
 * Time: 下午7:55
 */
include '../DAO/Database.php';
include 'method/DES.php';

$token = $_GET["token"];
$dao = getQuery("User");
$des = new DES("1996");

$email=explode( '^&*',($des->passport_decrypt($token)))[0];

echo $email;
$cnt = $dao->update(array("token"=>"NULL"),array("email"=>$email));
if($cnt){
    header("../View/login.html");
}
?>