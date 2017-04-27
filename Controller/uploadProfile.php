<?php
/**
 * Created by PhpStorm.
 * User: shoujiafeng
 * Date: 11/04/2017
 * Time: 11:25 PM
 */
//unfinished,need authentication
include_once "method/variable.php";
include_once "method/DES.php";
include "../DAO/Database.php";

$token = $_COOKIE["token"];
$des = new DES("1996");
$arr = explode('^&*', ($des->passport_decrypt($token)));
//print_r($arr);
$mail = $arr[0];
//$mail = "524867701@qq.com";
$dao = getQuery("User_profile");

//echo md5(md5($mail).md5($mail));
//print_r($_FILES);
if(isset($_FILES["photo"])){
    $name=$_FILES["photo"]["name"];
    $tmp=$_FILES["photo"]["tmp_name"];
    move_uploaded_file($tmp,$repositoryUrl."/../".md5(md5($mail).md5($mail))."/".$name);
    $cnt = $dao->update(array("photoname"=>$name),array("email"=>$mail));
    print_r($cnt);
}

if(isset($_POST["profile"])){
    $cnt =  $dao->update(array("profile"=>$_POST["profile"]),array("email"=>$mail));
    print_r($cnt);
}
if(isset($_POST["facebook"])){
    $cnt =  $dao->update(array("facebook"=>$_POST["facebook"]),array("email"=>$mail));
    print_r($cnt);
}
if(isset($_POST["goole"])){
    $cnt =  $dao->update(array("google"=>$_POST["google"]),array("email"=>$mail));
    print_r($cnt);
}
if(isset($_POST["twitter"])){
    $cnt =  $dao->update(array("twitter"=>$_POST["twitter"]),array("email"=>$mail));
    print_r($cnt);
}
if(isset($_POST["education"])){
    $cnt =  $dao->update(array("education"=>$_POST["education"]),array("email"=>$mail));
    print_r($cnt);
}
if(isset($_POST["experience"])){
    $cnt =  $dao->update(array("experience"=>$_POST["experience"]),array("email"=>$mail));
    print_r($cnt);
}
?>