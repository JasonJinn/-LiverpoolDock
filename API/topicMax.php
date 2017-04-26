<?php
/**
 * Created by PhpStorm.
 * User: shoujiafeng
 * Date: 11/04/2017
 * Time: 8:58 PM
 */
include "../DAO/Database.php";

$code=$_REQUEST["code"];
$type=$_REQUEST["type"];
$dao = getQuery("topic");
$cnt = $dao->getMax("topic_id",array("module_code"=>$code,"forum"=>$type,"isReport"=>'0'));

if(isset($cnt[0][0])){
    echo $cnt[0][0];
}else
    echo 0;
?>