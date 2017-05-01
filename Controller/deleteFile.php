<?php
/**
 * Created by PhpStorm.
 * User: shoujiafeng
 * Date: 12/04/2017
 * Time: 9:29 PM
 */
include "method/DES.php";
include_once "../DAO/Database.php";
include_once "method/tokenVerify.php";

$token=$_COOKIE["token"];
$filename=$_REQUEST["file_name"];
$type =$_REQUEST["repo_type"];

if(verifyToken($token)=="true"){
    $dao = getQuery("file");
    $cnt = $dao->update(array("isDelete"=>1),array("mail"=>$_COOKIE["mail"],
                                        "name"=>$filename,"Repo"=>$type));
    //echo $cnt;
}else{
    echo "token verify fail";
}
?>