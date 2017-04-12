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
$topic_id =$_REQUEST["topicID"];
$response_content =$_REQUEST["content"];

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


        $dao->table("topic_response");
        $result = $dao->getMax("floor_number",array("module_code" => $code, "forum" => $type,"topic_id"=>$topic_id));
        $max = $result[0][0] + 1;
        $date = date("Y/m/d H:m:s", time());

        $result1 = $dao->insert(array("topic_id" => $topic_id, "module_code" => $code, "forum" => $type,
            "email" => $email, "Username" => $username, "isReport" => 0,
            "time" => $date, "response_content" => $response_content, "floor_number" => $max));

        $dao->table("topic");

        $result2 = $dao->update(array("floor"=>$max,"time"=>$date),array("module_code" => $code,
                                                    "forum" => $type,"topic_id"=>$topic_id));
        if($result1=="0"&&$result2=="1")
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