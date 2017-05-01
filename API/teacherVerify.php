<?php
/**
 * Created by PhpStorm.
 * User: shoujiafeng
 * Date: 01/05/2017
 * Time: 5:47 PM
 */
include "../DAO/Database.php";

$dao = getQuery("User");
$result = $dao->get(array("email"=>$_COOKIE["mail"],"token"=>$_COOKIE["token"],
                            "level_of_security"=>1));
echo count($result)?"true":"false";
?>