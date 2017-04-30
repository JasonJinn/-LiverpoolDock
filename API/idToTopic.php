<?php
/**
 * Created by PhpStorm.
 * User: shoujiafeng
 * Date: 12/04/2017
 * Time: 9:02 PM
 */
include "../DAO/Database.php";
include_once "../Controller/method/variable.php";

$token = $_COOKIE["token"];

$code = $_REQUEST["code"];
$type = $_REQUEST["type"];
$topic = $_REQUEST["topic"];

echo file_get_contents($baseUrl."API/moduleList.php?token=".urlencode($token));
$moduleList=json_decode(file_get_contents($baseUrl."API/moduleList.php?token=".urlencode($token)),true);
print_r($moduleList);
if(isset($moduleList["$code"])) {
    $dao = getQuery("topic");
    $result = $dao->get("time", array("module_code" => $code, "forum" => $type,"topic_id"=>$topic,"isReport"=>'0'));
    echo $result[0]['topic_name'];
    //echo json_encode($total);

}else{
    echo "token invalid or no module access";
}
?>