<?php
/**
 * Created by PhpStorm.
 * User: shoujiafeng
 * Date: 2017/4/3
 * Time: 下午7:57
 */

include "../DAO/Database.php";
include_once '../Controller/method/DES.php';
include_once '../Controller/method/tokenVerify.php';
include_once '../Controller/method/variable.php';

$des = new DES("1996");
$token = $_GET["token"];

if(verifyToken($token)=="false"){
    echo "token invalid";
}else {
    $arr = explode('^&*', ($des->passport_decrypt($token)));
    $email = $arr[0];
    $dao = getQuery("User");
    $cnt = $dao->get(array("email"=>$email));
    $name = $cnt[0]["username"];

    $dao->table("User_profile");
    $cnt = $dao->get(array("email"=>$email));
    $path = $cnt[0]["photoname"];
    $path = $repositoryUrl."/../".md5(md5($email).md5($email))."/".$path;

    $hash = array("name"=>$name,"path"=>$path);
    echo json_encode($hash,JSON_UNESCAPED_SLASHES);
}

?>