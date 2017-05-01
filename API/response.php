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
$topic = $_REQUEST["topic_id"];

$moduleList=json_decode(file_get_contents($baseUrl."API/moduleList.php?token=".urlencode($token)),true);

if(isset($moduleList["$code"])) {
    $dao = getQuery("topic_response");
    $result = $dao->getByOrder("time", array("module_code" => $code, "forum" => $type,"topic_id"=>$topic,"isReport"=>'0'));
    $num=count($result);
    $hash=array();
    $total = array();
    $dao->table("topic");
    $result2 = $dao->get(array("module_code"=>$code,"forum"=>$type,"topic_id"=>$topic));
    for($i=0;$i<$num;$i++)
    {
        $dao->table("User_profile");
        $cnt = $dao->get(array("email"=>$email));
        $path = $cnt[0]["photoname"];
        //echo isset($path);
        if(isset($path))
            $path = $repositoryUrl1."/../".md5(md5($email).md5($email))."/".$path;
        else
            $path = $repositoryUrl1."/../default.jpg";

        $total[] = array("time"=>$result[$i]["time"],
                        "name"=>$result[$i]["Username"],
                        "content"=>$result[$i]["response_content"],
                        "mail"=>$result[$i]["email"],
                        "floor"=> $result[$i]["floor_number"],
                        "topic"=>$result2[0]["topic_name"],
                        "photo"=>$path);

    }
    echo json_encode($total,JSON_UNESCAPED_SLASHES);

}else{
    echo "token invalid or no module access";
}
?>