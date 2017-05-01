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

$token=$_COOKIE["token"];
$code=$_REQUEST["code"];
$poll_id =$_REQUEST["id"];

if(verifyToken($token)=="true"){

    $des = new DES("1996");
    $arr = explode('^&*', ($des->passport_decrypt($token)));
    $email = $arr[0];


    $dao = getQuery("User");
    $result=$dao->get(array("email"=>$email));

    $dao->table("votingpoll");
    $result1 = $dao->get(array("poll_id"=>$poll_id,"module_code"=>$code));
    if($result[0]["level_of_security"]>1 || ($result1[0]["email"]==$email)){                              //0 for student, 1 for teacher, 2 for manager
        $dao->table("votingpoll");
        $result = $dao->delete(array("poll_id"=>$poll_id,"module_code"=>$code));
        //print_r($result);
        if($result==1){
            $dao->table("votingOption");
            $result = $dao->delete(array("poll_id"=>$poll_id,"module_code"=>$code));

            echo "The poll has been deleted";
        }else{
            echo "The poll does not exist";
        }
    }else{
        echo "You are not permitted to delete this poll";
    }

}else{
    echo "token verify fail";
}
?>