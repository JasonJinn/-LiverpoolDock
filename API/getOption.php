<?php
/**
 * Created by PhpStorm.
 * User: shoujiafeng
 * Date: 14/04/2017
 * Time: 12:42 AM
 */
include_once "../Controller/method/tokenVerify.php";
include "../DAO/Database.php";
include "../Controller/method/variable.php";

$token = $_REQUEST["token"];
$code = $_REQUEST["code"];
$id=$_REQUEST["id"];

$moduleList=json_decode(file_get_contents($baseUrl."API/moduleList.php?token=".urlencode($token)),true);

if(isset($moduleList["$code"])) {
    $dao = getQuery("votingOption");
    $result=$dao->getDistinct("poll_option",array("poll_id"=>$id,"module_code"=>$code));

    $hash = array();
    $num=count($result);
    for($i=0;$i<$num;$i++)
    {
        $hash[$i]=$result[$i][0];
    }
    echo json_encode($hash);

    //echo json_encode($hash,JSON_UNESCAPED_SLASHES);
}else{
    echo "token invalid or no module access";
}
?>