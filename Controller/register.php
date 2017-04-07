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


$email=$_POST["email"];
$pass=$_POST["password"];
$give=$_POST["givenname"];
$sur=$_POST["surname"];
$level=4;                           //need to change

$dao = getQuery("User");
$cnt = $dao->insert(array("surname"=>$sur,"username"=>$give." ".$sur,"email"=>$email,"level_of_security"=>$level,"password"=>$pass));

if($cnt==0){
    $des = new DES("1996");
    $encrypt_mail = $des->passport_encrypt($email);
    sendMail($email,"Liverpool Dock account activate","http://localhost/-liverpooldock/Controller/mailActivate.php?secret=".urlencode($encrypt_mail));
    header("Location: ../View/registerSuccess.html");
}else{
    header("Location: ../View/login.html?registered=true");
}

?>