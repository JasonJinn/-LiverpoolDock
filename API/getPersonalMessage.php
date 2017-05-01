<?php
/**
 * Created by PhpStorm.
 * User: shoujiafeng
 * Date: 27/04/2017
 * Time: 9:32 PM
 */
include "../DAO/Database.php";
include_once '../Controller/method/tokenVerify.php';
include_once '../Controller/method/variable.php';

$timestamp = $_REQUEST["timestamp"];                        //timestamp should -1

$token = $_COOKIE['token'];
$name1 = $_COOKIE['mail'];
$name2 = $_REQUEST['user2_email'];

if(verifyToken($token)=="false"){
    echo "token invalid";
}else {
//echo $token.'<br>';
    $dao = getQuery('message');
    //echo $token;
    if(!isset($timestamp))
        $timestamp = date("Y-m-d H:i:s",time());
    //echo $timestamp;
    $result = $dao->query("select * from message where time<='$timestamp' and ((from_user= '$name1' and
to_user = '$name2') or (from_user= '$name2' and to_user = '$name1'))order by time desc limit 10");
    //print_r($result);
    $num = count($result);
    $total = array();
    $hash = array();
    for($i=0;$i<$num;$i++){
        $dao->table("User");
        $from_name = $dao->get(array("email"=>$result[$i]["from_user"]));
        $to_name = $dao->get(array("email"=>$result[$i]["to_user"]));

        $dao->table("User_profile");
        $from_cnt = $dao->get(array("email"=>$result[$i]["email"]));
        $from_path = $from_cnt[0]["photoname"];

        if(isset($from_path))
            $from_path = $repositoryUrl1."/../".md5(md5($email).md5($email))."/".$path;
        else
            $from_path = $repositoryUrl1."/../default.jpg";

        $to_cnt = $dao->get(array("email"=>$result[$i]["email"]));
        $to_path = $tp_cnt[0]["photoname"];

        if(isset($to_path))
            $to_path = $repositoryUrl1."/../".md5(md5($email).md5($email))."/".$path;
        else
            $to_path = $repositoryUrl1."/../default.jpg";

        $hash["from"] = $result[$i]["from_user"];
        $hash["from_name"] = $from_name[0]["username"];
        $hash["from_path"] = $from_path;
        $hash["to"] = $result[$i]["to_user"];
        $hash["to_name"] = $to_name[0]["username"];
        $hash["to_path"] = $to_path;
        $hash["read"] = $result[$i]["isRead"];
        $hash["content"] = $result[$i]["content"];
        $hash["time"] = $result[$i]["time"];

        $total[] = $hash;
    }
    $leastTimeStamp = $result[$num-1]["time"];
    $result = $dao->query("UPDATE message set isRead = 1 where time>='$leastTimeStamp' and time<='$timestamp'
    and ((from_user= '$name1' and to_user = '$name2') or (from_user= '$name2' and to_user = '$name1'))");
    echo json_encode($total,JSON_UNESCAPED_SLASHES);
}
?>