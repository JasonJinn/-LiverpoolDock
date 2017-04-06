<?php
/**
 * Created by PhpStorm.
 * User: shoujiafeng
 * Date: 2017/4/3
 * Time: 下午7:55
 */
include_once '../DAO/Database.php';
include_once "method/token.php";

$mail = $_POST["loginemail"];                                        //need change to post in the final
$password =$_POST["loginpassword"];

$dao = getQuery("User");
$result = $dao->get(array("email"=>$mail,"password"=>$password));
//print_r(array_values($result));

if($result && $result[0]["is_active"]){
    header("Location: ../View/homepage.html?token=".generateToken($mail));
    exit();
}else if($result && !$result[0]["is_active"]){
    header("Location: ../View/login.html?email=false");
    exit();
} else{
    header("Location: ../View/login.html?pass=false");
    exit();
}
?>