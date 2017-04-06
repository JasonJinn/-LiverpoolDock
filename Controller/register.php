<?php
/**
 * Created by PhpStorm.
 * User: shoujiafeng
 * Date: 2017/4/3
 * Time: 下午7:56
 */
include '../DAO/Database.php';
include 'method/DES.php';

$email=$_POST["email"];
$pass=$_POST["password"];
$give=$_POST["givenname"];
$sur=$_POST["surname"];
$level=4;

$dao = getQuery("User");
$cnt = $dao->insert(array("surname"=>$sur,"username"=>$give." ".$sur,"email"=>$email,"level_of_security"=>$level,"password"=>$pass));

$des = new DES("1996");
$encrypt_mail = $des->passport_encrypt($email);

mail($email,"Liverpool Dock account activate","http://localhost/-liverpooldock/Controller/mailActivate.php?secret=".$encrypt_mail);
header("Location: ../View/registerSuccess.html");
?>