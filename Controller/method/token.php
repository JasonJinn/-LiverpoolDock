<?php
/**
 * Created by PhpStorm.
 * User: shoujiafeng
 * Date: 2017/4/3
 * Time: 下午7:56
 */
include_once "DES.php";
include_once "../../DAO/Database.php";
include_once "variable.php";

function generateToken($mail){
    $str = $mail."^&*".time();
    $des = new DES("1996");
    $token = $des->passport_encrypt($str);
    $dao = getQuery("User");
    $dao->update(array("token"=>$token),array("email"=>$mail));
    setcookie("token",$token,time()+1800,"/",$domain);
    setcookie("mail",$mail,time()+1800,"/",$domain);
    return $token;
}

function decrptToken($token){
    $dao = getQuery('User');
    $des = new DES('1996');
    $arr = explode('^&*', ($des->passport_decrypt($token)));
    $email = $arr[0];
    return $email;
}

?>