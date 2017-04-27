<?php
/**
 * Created by PhpStorm.
 * User: shoujiafeng
 * Date: 2017/4/3
 * Time: 下午7:56
 */
include '../DAO/Database.php';
include_once 'method/DES.php';
include 'method/smtp.php';
include 'method/variable.php';
include_once "method/fileHandler.php";
include_once "method/variable.php";


$email=$_REQUEST["email"];
$pass=$_REQUEST["password"];
$give=$_REQUEST["givenname"];
$sur=$_REQUEST["surname"];
$level=$_REQUEST["level"];                           //teacher post 1, student post 0;
if(!isset($level)){
    $level = 0;
}
echo $level;
print_r($_REQUEST);
$dao = getQuery("User");
$result = $dao->get(array("email"=>$email));
$num = count($result);
if($num==0){
    $cnt = $dao->insert(array("surname"=>$sur,"username"=>$give." ".$sur,"email"=>$email,"level_of_security"=>$level,"password"=>$pass));
    if($level==1){
        maketeacherdir($give." ".$sur,$repositoryUrl);
    }
    $des = new DES("1996");
    $encrypt_mail = $des->passport_encrypt($email);
    sendMail($email,"Liverpool Dock account activate",$baseUrl."Controller/mailActivate.php?secret=".urlencode($encrypt_mail));
    header("Location: ../View/registerSuccess.html");
}else{
    header("Location: ../View/login.html?registered=true");
}

?>