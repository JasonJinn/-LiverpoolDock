<?php
/**
 * Created by PhpStorm.
 * User: shoujiafeng
 * Date: 11/04/2017
 * Time: 8:59 PM
 */
include "../DAO/Database.php";
include "../Controller/method/variable.php";

    $token = $_GET["token"];

    $code = $_GET["code"];
    $type = $_GET["type"];
    $page = $_GET["p"]||1;

    $moduleList=json_decode(file_get_contents($baseUrl."API/moduleList.php?token=".urlencode($token)),true);
//print_r($moduleList);
if(isset($moduleList["$code"])) {
    $dao = getQuery("topic");
    $result = $dao->getByOrder("time", array("module_code" => $code, "forum" => $type));

    $num = count($result);
    $from = ($page - 1) * $forumPage;
    $end = $page * $forumPage - 1;
    $hash = array();
    if ($num < $from) {
        $hash = null;
    } else {
        $num = $num < $end ? $num : $end;
        for ($i = $from; $i < $num; $i++) {
            $id = $result[$i]["topic_id"];
            $hash[$id]["time"] = $result[$i]["time"];
            $hash[$id]["name"] = $result[$i]["topic_name"];
            $hash[$id]["content"] = $result[$i]["topic_content"];
            $hash[$id]["floor"] = $result[$i]["floor"];
            $hash[$id]["user"] = $result[$i]["Username"];
        }
    }
    echo json_encode($hash);
}else{
    echo "token invalid or no module access";
}

?>