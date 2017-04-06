<?php
/**
 * Created by PhpStorm.
 * User: shoujiafeng
 * Date: 2017/4/3
 * Time: 下午7:56
 */
include "DES.php";
include_once "../DAO/Database.php";

function generateToken($mail){
    $str = $mail.".".time();
    $des = new DES("1996");
    $token = $des->passport_encrypt($str);
    $dao = getQuery("User");
    $dao->update(array("token"=>$token),array("email"=>$mail));
    return $token;
}

?>