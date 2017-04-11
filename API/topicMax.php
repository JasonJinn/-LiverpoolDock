<?php
/**
 * Created by PhpStorm.
 * User: shoujiafeng
 * Date: 11/04/2017
 * Time: 8:58 PM
 */
include "../DAO/Database.php";

$code=$_GET["code"];
$type=$_GET["type"];
$dao = getQuery("topic");
$cnt = $dao->getMax("topic_id",array("module_code"=>$code,"forum"=>$type));

print_r($cnt);
?>