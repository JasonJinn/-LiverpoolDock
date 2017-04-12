<?php
/**
 * Created by PhpStorm.
 * User: shoujiafeng
 * Date: 12/04/2017
 * Time: 9:29 PM
 */
include "method/DES.php";
include_once "../DAO/Database.php";
include_once "method/tokenVerify.php";

$token=$_REQUEST["token"];
$code=$_REQUEST["code"];
$type=$_REQUEST["type"];
$topic_name =$_REQUEST["topicname"];
$topic_content =$_REQUEST["content"];

if(verifyToken($token)=="true"){


    $des = new DES("1996");
    $arr = explode('^&*', ($des->passport_decrypt($token)));
    $email = $arr[0];


    $dao = getQuery("User_module");
    $result=$dao->get(array("email"=>$email,"module_code"=>$code));
    if(count($result)!=0) {

        $dao->table("User");
        $result = $dao->get(array("email" => $email));
        $username = $result[0]["username"];


        $dao->table("topic");
        $result = $dao->getMax("topic_id", array("module_code" => $code, "forum" => $type));
        $max = $result[0][0] + 1;

        $date = date("Y/m/d H:m:s", time());
        $result1 = $dao->insert(array("topic_id" => $max, "module_code" => $code, "forum" => $type, "topic_name" => $topic_name,
            "topic_content" => $topic_content, "Username" => $username, "email" => $email, "isReport" => 0,
            "time" => $date, "floor" => 1));

        $dao->table("topic_response");
        $result2 = $dao->insert(array("topic_id" => $max, "module_code" => $code, "forum" => $type,
            "email" => $email, "Username" => $username, "isReport" => 0,
            "time" => $date, "response_content" => $topic_content, "floor_number" => 1));

        if ($result1 == "0" && $result2 == "0")
            echo "transaction success";
        else
            echo "transaction failed";
    }else{
        echo "you cannot access this module";
    }
}else{
    echo "token verify fail";
}
?>