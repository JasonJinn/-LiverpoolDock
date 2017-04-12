<?php
/**
 * Created by PhpStorm.
 * User: shoujiafeng
 * Date: 12/04/2017
 * Time: 9:02 PM
 */
include "../DAO/Database.php";
include_once "../Controller/method/variable.php";

$token = $_GET["token"];

$code = $_GET["code"];
$type = $_GET["type"];
$topic = $_GET["topic"];

$moduleList=json_decode(file_get_contents($baseUrl."API/moduleList.php?token=".urlencode($token)),true);

if(isset($moduleList["$code"])) {
    $dao = getQuery("topic_response");
    $result = $dao->getByOrder("time", array("module_code" => $code, "forum" => $type,"topic_id"=>$topic));
    $num=count($result);
    $hash=array();
    for($i=0;$i<$num;$i++)
    {
        $hash[$result[$i]["floor_number"]] = array("time"=>$result[$i]["time"],
                                        "name"=>$result[$i]["Username"],
                                        "content"=>$result[$i]["response_content"],
                                        "mail"=>$result[$i]["email"]);
    }
    echo json_encode($hash);

}else{
    echo "token invalid or no module access";
}
?>