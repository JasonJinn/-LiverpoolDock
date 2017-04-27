<?php
/**
 * Created by PhpStorm.
 * User: shoujiafeng
 * Date: 27/04/2017
 * Time: 9:32 PM
 */
include "../DAO/Database.php";
include_once '../Controller/method/tokenVerify.php';
$timestamp = $_REQUEST["timestamp"];                        //timestamp should -1

$token = $_COOKIE['token'];
$name = $_COOKIE['mail'];

if(verifyToken($token)=="false"){
    echo "token invalid";
}else {
//echo $token.'<br>';
    $dao = getQuery('message');
    //echo $token;
    if(!isset($timestamp))
        $timestamp = date("Y-m-d H:i:s",time());
    //echo $timestamp;
    $result = $dao->query("select * from message where time<='$timestamp' and (from_user= '$name' or 
to_user = '$name')order by time desc limit 10");
    //print_r($result);
    $num = count($result);
    $total = array();
    $hash = array();
    for($i=0;$i<$num;$i++){
        $hash["from"] = $result[$i]["from_user"];
        $hash["to"] = $result[$i]["to_user"];
        $hash["read"] = $result[$i]["isRead"];
        $hash["content"] = $result[$i]["content"];
        $hash["time"] = $result[$i]["time"];

        $total[] = $hash;
    }
    $leastTimeStamp = $result[$num-1]["time"];
    $result = $dao->query("UPDATE message set isRead = 1 where time>='$leastTimeStamp' and time<='$timestamp'
    and (from_user= '$name' or to_user='$name')");
    echo json_encode($total);
}
?>