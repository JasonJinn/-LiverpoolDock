<?php
/**
 * Created by PhpStorm.
 * User: shoujiafeng
 * Date: 13/04/2017
 * Time: 10:30 PM
 */
include_once "../Controller/method/tokenVerify.php";
include "../DAO/Database.php";
include "../Controller/method/variable.php";

$token = $_COOKIE["token"];
$code = $_REQUEST["code"];
$page = $_REQUEST["p"]||1;

$moduleList=json_decode(file_get_contents($baseUrl."API/moduleList.php?token=".urlencode($token)),true);

if(isset($moduleList["$code"])) {
    $dao = getQuery("votingpoll");
    $result = $dao->getByOrder("poll_date",array("module_code" => $code));

    $num = count($result);
    $from = ($page - 1) * $forumPage;
    $end = $page * $forumPage - 1;
    $hash = array();
    if ($num < $from) {
        $hash = null;
    } else {
        $num = $num < $end ? $num : $end;
        for ($i = $from; $i < $num; $i++) {
            $id = $result[$i]["poll_id"];
            $hash[$id]["title"] = $result[$i]["poll_title"];
            $hash[$id]["date"] = $result[$i]["poll_date"];
            $hash[$id]["creator"] = $result[$i]["name"];
        }
    }
    echo json_encode($hash,JSON_UNESCAPED_SLASHES);
}else{
    echo "token invalid or no module access";
}
?>