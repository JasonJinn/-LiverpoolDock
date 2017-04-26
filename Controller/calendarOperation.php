<?php
/**
 * Created by PhpStorm.
 * User: shoujiafeng
 * Date: 25/04/2017
 * Time: 1:42 AM
 */
include_once '../DAO/Database.php';
include_once '../Controller/method/DES.php';
include_once '../Controller/method/tokenVerify.php';


$des = new DES('1996');
$token = $_COOKIE['token'];
$from = $_REQUEST['from'];
$end = $_REQUEST["end"];
$name = $_REQUEST["name"];
$operation = $_REQUEST["operation"];

if(verifyToken($token)=="false"){
    echo "token invalid";
}else {

    $arr = explode('^&*', ($des->passport_decrypt($token)));
    $email = $arr[0];

    $dao = getQuery('calendar');
    if($operation=="add"){
        $cnt = $dao->insert(array("email"=>$email,"event_from"=>$from,"event_end"=>$end,
            "event_name"=>$name));
        if($cnt==0){
            echo "add successfully";
        }else{
            echo "User has the same event";
        }
    }else if($operation=="delete"){
        $cnt = $dao->delete(array("email"=>$email,"event_from"=>$from,"event_end"=>$end,
            "event_name"=>$name));
        //print_r($cnt);
        if($cnt==1){
            echo "delete successfully";
        }else{
            echo "User doesn't have that event";
        }
    }else{
        echo "wrong operation instruction";
        }
}
?>