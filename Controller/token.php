<?php
/**
 * Created by PhpStorm.
 * User: shoujiafeng
 * Date: 2017/4/3
 * Time: 下午7:56
 */
include "DES.php";

function generateToken($mail){
    $str = $mail.".".time();
    return passport_encrypt($str,"1996");
}
?>