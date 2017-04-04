<?php
/**
 * Created by PhpStorm.
 * User: shoujiafeng
 * Date: 2017/4/3
 * Time: 下午7:55
 */
include '../DAO/Database.php';

$mail = $_POST["loginemail"];                                        //need change to post in the final
$password =$_POST["loginpassword"];


$dao = getQuery("User");
$result = $dao->get(array("email"=>$mail,"password"=>$password));
//print_r(array_values($result));
if($result){
    echo "success";
}else{
    echo "fail";
}
?>