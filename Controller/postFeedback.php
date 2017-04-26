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

$token=$_COOKIE["token"];                                                      //scale?
$content =$_REQUEST["content"];

if(verifyToken($token)=="true"){

    $des = new DES("1996");
    $arr = explode('^&*', ($des->passport_decrypt($token)));
    $email = $arr[0];

    $dao = getQuery("application_feedback");
    $result = $dao->getMax("feedback_id");
    $next_id = $result[0][0]+1;
    echo $next_id;
    $time = date("Y/m/d H:i:s", time());
    $cnt = $dao->insert(array("feedback_id"=>$next_id,"email"=>$email,"feedback_content"=>$content,
        "feedback_date"=>$time));
    print_r($cnt);
    if($cnt==0){
        echo "upload success";
    }else{
        echo "upload failed";
    }
}else{
    echo "token verify fail";
}

?>