<?php
/**
 * Created by PhpStorm.
 * User: shoujiafeng
 * Date: 13/04/2017
 * Time: 11:30 PM
 **/
include_once "../Controller/method/tokenVerify.php";
include "../DAO/Database.php";
include "../Controller/method/variable.php";

$token = $_REQUEST["token"];
$code = $_REQUEST["code"];
$id=$_REQUEST["id"];
$option = $_REQUEST["option"];

$moduleList=json_decode(file_get_contents($baseUrl."API/moduleList.php?token=".urlencode($token)),true);

if(isset($moduleList["$code"])) {
    $dao = getQuery("votingOption");
    if(isset($option)) {
        $result = $dao->getCount(array("module_code" => $code, "poll_id" => $id, "poll_option" => $option));
        $num=$result[0][0]-1;
    }else{
        $result = $dao->getCount(array("module_code" => $code, "poll_id" => $id));
        $result1 = $dao->get(array("module_code" => $code, "poll_id" => $id,"email"=>"null"));
        $num=$result[0][0]-count($result1);
    }
    echo $num;

    //echo json_encode($hash,JSON_UNESCAPED_SLASHES);
}else{
    echo "token invalid or no module access";
}
?>