<?php
/**
 * Created by PhpStorm.
 * User: shoujiafeng
 * Date: 2017/4/3
 * Time: 下午7:56
 */
include '../DAO/Database.php';

$email=$_POST["email"];
$pass=$_POST["password"];
$give=$_POST["givenname"];
$sur=$_POST["surname"];
$level=4;

$dao = getQuery("User");
$cnt = $dao->insert(array("surname"=>$sur,"username"=>$give." ".$sur,"email"=>$email,"level_of_security"=>$level,"password"=>$pass));

header("Location: ../View/registerSuccess.html");
?>