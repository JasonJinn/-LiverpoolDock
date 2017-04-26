<?php
/**
 * Created by PhpStorm.
 * User: shoujiafeng
 * Date: 2017/4/3
 * Time: 下午7:55
 */
include_once '../DAO/Database.php';
include_once "method/token.php";

$mail = $_REQUEST["loginemail"];                                        //need change to post in the final
$password =$_REQUEST["loginpassword"];

$dao = getQuery("User");
$result = $dao->get(array("email"=>$mail));
//print_r(array_values($result));                                        //need test.
//echo $password."<br/>";
//echo md5(md5($result[0]["password"]).md5($result[0]["password"]));
if($password==md5(md5($result[0]["password"]).md5($result[0]["password"]))) {
    if ($result && $result[0]["is_active"]) {
        generateToken($mail);
        header("Location: ../View/homepage.html");
        exit();
    } else if ($result && !$result[0]["is_active"]) {
        header("Location: ../View/login.html?email=false");
        exit();
    } else {
        header("Location: ../View/login.html?pass=false");
        exit();
    }
}else{
    header("Location: ../View/login.html?pass=false");
}
?>