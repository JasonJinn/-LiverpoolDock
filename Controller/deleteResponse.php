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
$floor=$_REQUEST["floor"];
$topic_id =$_REQUEST["id"];
$type = $_REQUEST["type"];


if(verifyToken($token)=="true"){

    $des = new DES("1996");
    $arr = explode('^&*', ($des->passport_decrypt($token)));
    $email = $arr[0];

    $dao = getQuery("User");
    $result=$dao->get(array("email"=>$email));

    $dao->table("topic_response");
    $result1 = $dao->get(array("topic_id"=>$topic_id,"module_code"=>$code,"forum"=>$type,"floor_number"=>$floor));
    //print_r($result1);
    if($result[0]["level_of_security"]>1 || ($result1[0]["email"]==$email)){                              //0 for student, 1 for teacher, 2 for manager
        $dao->table("topic_response");
        $result = $dao->update(array("isReport"=>1),array("topic_id"=>$topic_id,"module_code"=>$code,"forum"=>$type,"floor_number"=>$floor));
        //print_r($result);
        if($result==1){
            echo "The topic has been deleted";
        }else{
            echo "The response does not exist";
        }
    }else{
        echo "You are not permitted to delete this response";
    }

}else{
    echo "token verify fail";
}
?>